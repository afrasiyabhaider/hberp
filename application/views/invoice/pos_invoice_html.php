<?php
$CI = & get_instance();
$CI->load->model('Web_settings');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>
<!--its for pos style css start--> 
<style type="text/css">
    BODY, TD
    {
        background-color: #ffffff;
        color: #000000;
        font-family: "Times New Roman", Times, serif;
        font-size: 10pt;
    }

</style>
<!--its for pos style css close--> 
<!-- Printable area start -->
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        // document.body.style.marginTop="-45px";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<!-- Printable area end -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_details') ?></h1>
            <small><?php echo display('invoice_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_details') ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('error_message');
        }
        ?>
        <div class="row" id="printBoth">
            <div class="col-sm-6">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                            <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' style='margin:0;font-family:Arial,Helvetica,sans-serif;border-bottom:1'>
                                <table border="0" width="100%">
                                    <tr>
                                        <td>

                                            <table border="0" width="100%">
                                                {company_info}
                                                <tr>
                                                    <td align="center" style="border-bottom:2px #333 solid;">
                                                        <span style="font-size: 17pt; font-weight:bold;">
                                                            {company_name}
                                                        </span><br>
                                                        {address}<br>
                                                        {mobile}
                                                    </td>
                                                </tr>
                                                {/company_info}
                                                <tr>
                                                    <td align="center"><b>{customer_name} ( {customer_location} )</b><br>
                                                        <?php if ($customer_address) { ?>
                                                            {customer_address}<br>
                                                        <?php } ?>
                                                        <?php if ($customer_mobile) { ?>
                                                            {customer_mobile}
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><nobr>
                                                    <date>
                                                        Date: <?php
                                                        echo date("d-M-Y", strtotime($date));
                                                        ?> 
                                                    </date>
                                                </nobr></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo display('invoice_no'); ?> : {invoice_no}</strong></td>
                                    </tr>
                                </table>

                                <table width="100%">
                                    <tr>
                                        <td><?php echo display('sl'); ?></th>
                                        <td><?php echo display('product_name'); ?></td>
                                        <td align="right"><?php echo display('quantity'); ?></td>
                                        <td align="right"><?php echo display('discount'); ?></td>
                                        <td align="right"><?php echo display('rate'); ?></td>
                                        <td align="right"><?php echo display('ammount'); ?></td>
                                    </tr>
                                    {invoice_all_data}
                                    <tr>
                                    <td align="left" style="font-size: 20px;"><nobr>{sl} - </nobr></td>
                                    <td align="left" style="font-size: 20px;"><nobr>{product_name}
                                    <?php if($show_invoice_model == 1){?>
                                         -  ({product_model})
                                    <?php }?>
                                    </nobr></td>
                                    <td align="right" style="font-size: 20px;"><nobr>{quantity}</nobr></td>
                                    <td align="right" style="font-size: 20px;">
                                    <nobr>
                                        <?php if(isset($discount_per)){?>
                                         <?php  echo (($position == 0) ? "$currency {discount_per}" : "{discount_per} $currency") ?>
                                        <?php }?>
                                    </nobr>
                                    </td>
                                    <td align="right"  style="font-size: 20px;">
                                    <nobr>
                                        <?php echo (($position == 0) ? "$currency {rate}" : "{rate} $currency") ?>
                                    </nobr>
                                    </td>
                                    <td align="right"  style="font-size: 20px;">
                                    <nobr>
                                        <?php echo (($position == 0) ? "$currency {total_price}" : "{total_price} $currency") ?>
                                    </nobr>
                                    </td>
                                    </tr>
                                    {/invoice_all_data}
                                    <tr>
                                        <td style="border-top:#333 1px solid;"></td>
                                        <td style="border-top:#333 1px solid;" align="right"><nobr>Total Quantity</nobr></td>
                                        <td align="right" style="border-top:#333 1px solid;"><nobr>{subTotal_quantity}</nobr></td>
                                        <td style="border-top:#333 1px solid;"></td>
                                        <td style="border-top:#333 1px solid;"></td>
                                        <td style="border-top:#333 1px solid;"></td>
                                    </tr>
                                    <?php if($total_tax != "0.00"){ ?>
                                    
                                    <tr>
                                        <td align="left"><nobr>{subTotal_quantity}</nobr></td>
                                    <td align="right" colspan="4"  style="font-size: 20px;"><nobr><?php echo display('tax') ?></nobr></td>
                                    <td align="right"  style="font-size: 20px;">
                                    <nobr>
                                        <?php echo (($position == 0) ? "$currency {total_tax}" : "{total_tax} $currency") ?>
                                    </nobr>
                                    </td>
                                    </tr>
                                    <?php }?>
								
									
                                    <tr>
                                        <td colspan="6" style="border-top:#333 1px solid;"><nobr></nobr></td>
                                    </tr>
                                    <?php if($invoice_discount != "0.00"){ ?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="4"  style="font-size: 20px;"><nobr><?php echo display('invoice_discount'); ?></nobr></td>
                                    <td align="right"  style="font-size: 20px;"><nobr>
                                        <?php echo (($position == 0) ? "$currency {invoice_discount}" : "{invoice_discount} $currency") ?>
                                    </nobr></td>
                                    </tr>
                                    <?php }?>
                                    <?php if($total_discount != "0.00"){ ?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="4"  style="font-size: 20px;"><nobr><?php echo display('total_discount') ?></nobr></td>
                                    <td align="right"  style="font-size: 20px;">
                                    <nobr>
                                        <?php echo (($position == 0) ? "$currency {total_discount}" : "{total_discount} $currency") ?>
                                    </nobr></td>
                                    </tr>
                                    <?php }?>
                                    <tr>
                                        <td colspan="6" style="border-top:#333 1px solid;"><nobr></nobr></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="left"  style="font-size: 20px;" colspan="4"><nobr><strong>Total</strong></nobr></td>
                                    <td align="right"  style="font-size: 20px;"><nobr>
                                        <strong>
                                            <?=$currency.' '.$total_amount?>
                                        </strong></nobr></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="border-top:#333 1px solid;"><nobr></nobr></td>
                                    </tr>
                                    <?php if ($expense != 0) { ?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="left"  style="font-size: 20px;" colspan="4"><nobr><strong>Expense</strong></nobr></td>
                                    <td align="right"  style="font-size: 20px;"><nobr>
                                        <strong>
                                            <?php echo (($position == 0) ? "$currency {expense}" : "{expense} $currency") ?>
                                        </strong></nobr></td>
                                    </tr>
                                    <?php }?>
                                    <?php if($showBalance != 0){?>
                                    <tr>
                                    <td align="left"><nobr></nobr></td>
                                    <td align="left"  style="font-size: 20px;" colspan="4"><nobr><strong>Balance</strong></nobr></td>
                                    <td align="right"  style="font-size: 20px;"><nobr>
                                        <strong>
                                           <?=$currency.' '.number_format($showBalance,2)?>
                                        </strong></nobr></td>
                                    </tr>
                                    <?php }?>
                                    <tr><td align="left"><nobr></nobr></td>
                                    <td align="left"  style="font-size: 20px;" colspan="4"><nobr><strong><?php echo display('grand_total') ?></strong></nobr></td>
                                    <td align="right"  style="font-size: 20px;"><nobr>
                                        <strong><?php echo $currency; ?> <?php if($gTotal != "0.00") { echo number_format($gTotal,2); $g = $gTotal;}else{ echo $total_amount; $g = $total_amount;} ?>
                                          
                                        </strong></nobr></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="border-top:#333 1px solid;"><nobr></nobr></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="left"  style="font-size: 20px;" colspan="4"><nobr>
                                       <strong> <?php echo display('paid_ammount') ?></strong>
                                    </nobr></td>
                                    <td align="right"  style="font-size: 20px;"><nobr>
                                        <strong><?php echo (($position == 0) ? "$currency {paid_amount}" : "{paid_amount} $currency") ?></strong>
                                    </nobr></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="left"  style="font-size: 20px;" colspan="4"><nobr><strong><?php echo display('due') ?></strong></nobr></td>
                                    <td align="right" style="font-size: 20px;"><nobr>
                                        <strong><?php echo (($position == 0) ? "$currency {due_amount}" : "{due_amount} $currency") ?></strong>
                                    </nobr></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="border-top:#333 1px solid;"><nobr></nobr></td>
                                    </tr>
                                </table>
                                <table width="100%">
                                    <tr>
                                        <!--<td>Receipt  No:1032</td>-->
                                        <td align="right">User: Haris</td>
                                    </tr>
                                </table>
                                </td>
                                </tr>
                                <tr>
                                <td>Powered  By: <strong>Better.AI Technologies </br>Contact: 03315345412</strong></a></td>
                                </tr>
                                </table>
                            </div>


                        </div>
                    </div>

                    <div class="panel-footer text-left">
                        <a  class="btn btn-danger hidden-print" href="<?php echo base_url('Cinvoice'); ?>"><?php echo display('cancel') ?></a>
                        <a  class="btn btn-info hidden-print" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>

                    </div>
                </div>
            </div>
			
			
			
			<!------------------------------------------>
			
			
			
			<div class="col-sm-6">
                <div class="panel panel-bd">
                    <div id="printableArea1">
                        <div class="panel-body">
                            <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' style='margin:0;font-family:Arial,Helvetica,sans-serif;border-bottom:1'>
                               <?php
                                $checkL  = array();
                               foreach($invoice_all_data as $dInvice){
                                   if(@!in_array($dInvice['store_location'], $checkL)){
                                       $checkL[] = $dInvice['store_location'];
                               ?>
                                <table border="0" width="100%">
                                    <tr>
                                        <td>

                                            <table border="0" width="100%">
                                                {company_info}
                                                <tr>
                                                    <td align="center" style="border-bottom:2px #333 solid;">
                                                        <span style="font-size: 17pt; font-weight:bold;">
                                                            {company_name} - (<?=$dInvice['store_location']?>)
                                                        </span><br>
                                                        {address}<br>
                                                        {mobile}
                                                    </td>
                                                </tr>
                                                {/company_info}
                                                <tr>
                                                    <td align="center"><b>{customer_name} ( {customer_location} )</b><br>
                                                        <?php if ($customer_address) { ?>
                                                            {customer_address}<br>
                                                        <?php } ?>
                                                        <?php if ($customer_mobile) { ?>
                                                            {customer_mobile}
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><nobr>
                                                    <date>
                                                        Date: <?php
                                                        echo date("d-M-Y", strtotime($date));
                                                        ?>
                                                    </date>
                                                </nobr></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo display('invoice_no'); ?> : {invoice_no}</strong></td>
                                    </tr>
                                </table>

                                <table width="100%" >
                                    <tr>
                                        <td><?php echo display('product_name'); ?></td>
                                        <td align="right"><?php echo display('quantity'); ?></td>
                                    </tr>
                                    <?php 
                                       $qty = 0;
                                       foreach($invoice_all_data as $iInvice){
                                    ?>
                                    <?php 
                                    if($iInvice['store_location'] == $dInvice['store_location']){
                                        $qty += $iInvice['quantity'];
                                    ?>
                                    <tr>
										<td align="left" style="font-size: 20px;"><nobr><?=$iInvice['product_name']?>
										<?php if($show_invoice_store_model == 1){?>
                                          - (<?=$iInvice['product_model']?>) 
                                       <?php }?>
										</nobr></td>
										<td align="right" style="font-size: 20px;"><nobr><?=$iInvice['quantity']?></nobr></td>
                                    </tr>
                                    <?php  }
                                    }?>
                                    <tr>
                                        <td colspan="6" style="border-top:#333 1px solid;"><nobr></nobr></td>
                                    </tr>
                                    <tr>
                                        <td>Total Quantity</td>
                                        <td align="right" ><?php echo $qty;?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="border-top:#333 1px solid;"><nobr></nobr></td>
                                    </tr>
								</table>
                                <table width="100%">
                                    <tr>
                                        <!--<td>Receipt  No:1032</td>-->
                                        <td align="right">User: Haris</td>
                                    </tr>
                                </table>
                                </td>
                                </tr>
                                <tr>
                                <td>Powered  By: <strong>Better.AI Technologies </br>Contact: 03315345412</strong></a></td>
                                </tr>
                                </table>
                                <br>
                                <br>
                                <?php }}?>
                                
                            </div>


                        </div>
                    </div>

                    <div class="panel-footer text-left">
                        <a  class="btn btn-danger hidden-print" href="<?php echo base_url('Cinvoice'); ?>"><?php echo display('cancel') ?></a>
                        <a  class="btn btn-info hidden-print" href="#" onclick="printDiv('printableArea1')"><span class="fa fa-print"></span></a>
                    </div>
                </div>
            </div>
        </div>
	    <a  class="btn btn-info" href="#" onclick="printDiv('printBoth')"><span class="fa fa-print"></span> Both</a>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->