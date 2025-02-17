<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('role_type_id');
            $table->boolean('add_shipment')->default(false);
            $table->boolean('view_shipment')->default(false);
            $table->boolean('edit_shipment')->default(false);
            $table->boolean('delete_shipment')->default(false);
            $table->boolean('view_charges')->default(false);
            $table->boolean('add_charges')->default(false);
            $table->boolean('edit_charges')->default(false);
            $table->boolean('delete_charges')->default(false);
            $table->boolean('add_products')->default(false);
            $table->boolean('edit_products')->default(false);
            $table->boolean('delete_products')->default(false);
            $table->boolean('add_status')->default(false);
            $table->boolean('edit_status')->default(false);
            $table->boolean('delete_status')->default(false);
            $table->boolean('update_payment_status')->default(false);
            $table->boolean('delete_payment_status')->default(false);
            $table->boolean('bulk_upload')->default(false);
            $table->boolean('bulk_update')->default(false);
            $table->boolean('bulk_assign')->default(false);
            $table->boolean('bulk_delete')->default(false);
            $table->boolean('view_shipments_other_branch')->default(false);
            $table->boolean('edit_shipments_other_branch')->default(false);
            $table->boolean('delete_shipments_other_branch')->default(false);
            $table->boolean('view_charges_other_branch')->default(false);
            $table->boolean('edit_charges_other_branch')->default(false);
            $table->boolean('add_products_other_branch')->default(false);
            $table->boolean('edit_products_other_branch')->default(false);
            $table->boolean('delete_products_other_branch')->default(false);
            $table->boolean('add_status_other_branch')->default(false);
            $table->boolean('edit_status_other_branch')->default(false);
            $table->boolean('delete_status_other_branch')->default(false);
            $table->boolean('update_others_payment_status_other_branch')->default(false);
            $table->boolean('delete_others_payment_status_other_branch')->default(false);
            $table->boolean('add_container')->default(false);
            $table->boolean('edit_container')->default(false);
            $table->boolean('update_container_status')->default(false);
            $table->boolean('assign_shipment_to_container')->default(false);
            $table->boolean('delete_container')->default(false);
            $table->boolean('print_manifest')->default(false);
            $table->boolean('view_all_containers_other_branch_containers')->default(false);
            $table->boolean('edit_container_other_branch_containers')->default(false);
            $table->boolean('update_container_status_other_branch_containers')->default(false);
            $table->boolean('assign_shipment_to_container_other_branch_containers')->default(false);
            $table->boolean('delete_container_other_branch_containers')->default(false);
            $table->boolean('print_manifest_other_branch_containers')->default(false);
            $table->boolean('view_customers')->default(false);
            $table->boolean('view_all_branch_customers')->default(false);
            $table->boolean('edit_customer')->default(false);
            $table->boolean('edot_other_branch_customer')->default(false);
            $table->boolean('customer_wallet')->default(false);
            $table->boolean('all_customer_invoices')->default(false);
            $table->boolean('delete_customer')->default(false);
            $table->boolean('delete_other_branch_customer')->default(false);
            $table->boolean('manage_customer_request_other_branches')->default(false);
            $table->boolean('download_reports')->default(false);
            $table->boolean('download_reports_all')->default(false);
            $table->boolean('hide_dashboard_progress')->default(false);
            $table->boolean('manage_drivers')->default(false);
            $table->boolean('assign_drivers')->default(false);
            $table->boolean('assign_drivers_other_branch')->default(false);
            $table->boolean('delete_drivers')->default(false);
            $table->boolean('shipment_activity')->default(false);
            $table->boolean('disable_tracking_number')->default(false);
            $table->boolean('update_any_status_driver')->default(false);
            $table->boolean('update_status_driver')->default(false);
            $table->boolean('close_job_after_any_update_driver')->default(false);
            $table->boolean('update_payment_status_driver')->default(false);
            $table->boolean('create_request_customer')->default(false);
            $table->boolean('view_shipment_customer')->default(false);
            $table->boolean('edit_shipment_customer')->default(false);
            $table->boolean('cancel_shipment_before_shipping_customer')->default(false);
            $table->boolean('delete_shipment_customer')->default(false);
            $table->boolean('add_products_customer')->default(false);
            $table->boolean('edit_products_customer')->default(false);
            $table->boolean('delete_products_customer')->default(false);
            $table->boolean('hide_welcome_popup_customer')->default(false);
            $table->boolean('hide_charges_customer')->default(false);
            $table->boolean('add_payer_charges_customer')->default(false);
            $table->boolean('auto_calculate_charges_customer')->default(false);
            $table->boolean('simple_pre_alert_form_customer')->default(false);
            $table->boolean('excel_request_upload_customer')->default(false);
            $table->boolean('support_ticketing_system_customer')->default(false);
            $table->boolean('hide_dashboard_charts_show_quick_shipments_customer')->default(false);
            $table->boolean('show_billing_and_invoice_section_customer')->default(false);
            $table->boolean('automatically_approve_customer_request_customer')->default(false);
            $table->boolean('allow_chat_with_branches_and_staffs_customer')->default(false);
            $table->boolean('hide_printing_package_slips_and_labels_customer')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
