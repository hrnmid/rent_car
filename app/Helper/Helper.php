<?php
namespace App\Helper;

use App\Models\PreAlerts;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Dcblogdev\Xero\Facades\Xero;
use Dcblogdev\Xero\Resources\Invoices; // Import kelas Invoices

class Helper
{
    public static function getInitial($param)
    {
        return mb_substr($param, 0, 1);

    }

    


    public static function findByField($field, $table, $where = '')
    {
        $sql = "SELECT $field as result FROM $table where 1=1 $where";
        //echo $sql;
        //die;
        $rows = DB::select($sql);


        $hasil = "";
        foreach ($rows as $hsl) {
            $hasil = $hsl->result;
        }
        return $hasil;
    }

    public static function createStripe($id, $jenis)
    {

        //QUERY PRE_ALERT
        $sqlprelart = "
        SELECT A.invoice_no,A.invoice_date,A.invoice_due
        FROM pre_alerts A 
        WHERE id ='$id'
        ";
        $rows = DB::select($sqlprelart);
        $invoice_no = $rows[0]->invoice_no;
        $invoice_due = $rows[0]->invoice_due;
        $invoice_date = $rows[0]->invoice_date;

        //QUERY SHIPING_CHARGES
        $sqlshippingcharges = "
        SELECT B.chargename,A.qtyc,A.fee
        FROM shipping_charges A 
        LEFT JOIN charges B ON A.chargeid=B.chargeid
        WHERE pre_alert_id ='$id'
        ";
        $rowsdetail = DB::select($sqlshippingcharges);
        $lineItems = [];
        foreach ($rowsdetail as $index => $hsl) {

            $chargename = $hsl->chargename;
            $qtyc = $hsl->qtyc;
            $fee = $hsl->fee;

            $arr_item = [
                'Description' => $chargename,
                'Quantity' => $qtyc,
                'UnitAmount' => $fee,
                'AccountCode' => '200',
                'TaxAmount' => '0'
            ];

            // Tambahkan item ke dalam array $lineItems
            $lineItems[] = $arr_item;
        }

         
        $invoiceData = [
            'Contact' => [
                'ContactID' => 'f93cd75c-9412-4a8c-91a3-b41fe751aa01' // ID kontak Xero
            ],
            'Type' => 'ACCREC', // Jenis invoice
            'Date' => $invoice_date, // Tanggal invoice
            'DueDate' => $invoice_due, // Tanggal jatuh tempo
            'Reference' => 'Indobox Asia Demo',
            'Status' => 'AUTHORISED',
            'InvoiceNumber' => $invoice_no,
            'LineItems' => $lineItems,

        ];
       
        $invoices = new Invoices();

        // Membuat invoice menggunakan metode store() dari kelas Invoices
        $result = $invoices->store($invoiceData);
        $link = Xero::invoices()->onlineUrl($result['InvoiceID']);
        $post = PreAlerts::find($id);
        if ($post) {
            $post->invoice_link = $link;
            $post->invoice_id = $result['InvoiceID'];
            $post->save();
        }
       
        return Xero::invoices()->onlineUrl($result['InvoiceID']);
    }
    public static function getStatus($type, $id)
    {
        if ($type == "status"){
            $sql = "
            SELECT A.datetime,B.name,IFNULL(B.name,A.status) AS result,A.location,A.remarks 
            FROM shipment_statuses A 
             LEFT JOIN shipment_status_lists B ON A.statusid=B.id
             WHERE A.shipment_id='".$id."'
             ORDER BY A.datetime DESC LIMIT 1
 ";
            $rows = DB::select($sql);
            $hasil="";
            foreach ($rows as $hsl) {
                $hasil = $hsl->result;
            }
            return $hasil;
        }
     return "";
    }


    public static function getInvoice($type, $id)
    {
        if ($type == "status"){
            $sql = "SELECT A.id, 
            CASE WHEN ((IFNULL(B.amount_paid,0)) >= (IFNULL(C.subtotal,0))) and (IFNULL(C.subtotal,0)) > 0 THEN 'paid' ELSE 'unpaid' END AS result
                        FROM pre_alerts A 
                         LEFT JOIN (
                           SELECT pre_alert_id,SUM(IFNULL(subtotal,0)) AS subtotal FROM shipping_charges 
                           WHERE  is_active='1'
                           GROUP BY pre_alert_id
                        )C ON A.id=C.pre_alert_id 
                        LEFT JOIN (
                           SELECT pre_alert_id,SUM(IFNULL(amount,0)) AS amount_paid FROM receipts 
                           WHERE receipt_status='1'	AND is_active='1'
                           GROUP BY pre_alert_id
                        )B ON A.id=B.pre_alert_id 
                        WHERE A.id='".$id."'";
            $rows = DB::select($sql);
            foreach ($rows as $hsl) {
                $hasil = $hsl->result;
            }
            return $hasil;
        }else if ($type == "total"){
            $sql = "
            SELECT A.id, (IFNULL(C.subtotal,0)) AS result
            FROM pre_alerts A 
             LEFT JOIN (
               SELECT pre_alert_id,SUM(IFNULL(subtotal,0)) AS subtotal FROM shipping_charges 
               WHERE  is_active='1'
               GROUP BY pre_alert_id
            )C ON A.id=C.pre_alert_id 
            LEFT JOIN (
               SELECT pre_alert_id,SUM(IFNULL(amount,0)) AS amount_paid FROM receipts 
               WHERE receipt_status='1'	AND is_active='1'
               GROUP BY pre_alert_id
            )B ON A.id=B.pre_alert_id 
            WHERE A.id='".$id."'
            ";
            $rows = DB::select($sql);
            $hasil = "";
            foreach ($rows as $hsl) {
                $hasil = $hsl->result;
            }
            return $hasil;
        }else if ($type == "unpaid"){
            $sql = "
            SELECT A.id, (IFNULL(C.subtotal,0))- (IFNULL(B.amount_paid,0)) AS result
            FROM pre_alerts A 
             LEFT JOIN (
               SELECT pre_alert_id,SUM(IFNULL(subtotal,0)) AS subtotal FROM shipping_charges 
               WHERE  is_active='1'
               GROUP BY pre_alert_id
            )C ON A.id=C.pre_alert_id 
            LEFT JOIN (
               SELECT pre_alert_id,SUM(IFNULL(amount,0)) AS amount_paid FROM receipts 
               WHERE receipt_status='1'	AND is_active='1'
               GROUP BY pre_alert_id
            )B ON A.id=B.pre_alert_id 
            WHERE A.id='".$id."'
            ";
            $rows = DB::select($sql);
            $hasil = "";
            foreach ($rows as $hsl) {
                $hasil = $hsl->result;
            }
            return $hasil;
        }else if ($type == "paid"){
            $sql = "
            SELECT SUM(IFNULL(B.amount_paid,0)) AS result
            FROM pre_alerts A 
            LEFT JOIN (
               SELECT pre_alert_id,SUM(IFNULL(amount,0)) AS amount_paid FROM receipts 
               WHERE receipt_status='1'	AND is_active='1'
               GROUP BY pre_alert_id
            )B ON A.id=B.pre_alert_id 
            WHERE A.id='".$id."'
            ";
            $rows = DB::select($sql);
            $hasil = "";
            foreach ($rows as $hsl) {
                $hasil = $hsl->result;
            }
            return $hasil;
        }
     return "";
    }


    
}
