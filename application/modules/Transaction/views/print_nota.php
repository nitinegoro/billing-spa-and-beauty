
<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <title>
            <?php echo $this->app->get('app_title'); ?>
        </title>
        <style type="text/css">
            html {
                font-family: "Verdana";
            }
            .content {
                width: 50mm;
                font-size: 10px;
            }
            .content .title {
                text-align: center;
            }
            .content .head-desc {
                margin-top: 20px;
                display: table;
                width: 100%;
            }
            .content .head-desc > div {
                display: table-cell;
            }
            .content .head-desc .user {
                text-align: right;
            }
            .content .nota {
                text-align: center;
                margin-top: 5px;
                margin-bottom: 5px;
            }
            .content .separate {
                margin-top: 20px;
                margin-bottom: 15px;
                border-top: 1px dashed #000;
            }
            .content .transaction-table {
                width: 100%;
                font-size: 12px;
            }
            .content .transaction-table .name {
                width: 185px;
            }
            .content .transaction-table .qty {
                text-align: center;
            }
            .content .transaction-table .sell-price, .content .transaction-table .final-price {
                text-align: right;
                width: 65px;
            }
            .content .transaction-table tr td {
                vertical-align: top;
                font-size: 9px;
            }
            .content .transaction-table .price-tr td {
                padding-top: 5px;
                padding-bottom: 7px;
            }
            .content .transaction-table .discount-tr td {
                padding-top: 7px;
                padding-bottom: 7px;
            }
            .content .transaction-table .separate-line {
                height: 1px;
                border-top: 1px dashed #000;
            }
            .content .thanks {
                margin-top: 25px;
                text-align: center;
            }
            .content .azost {
                margin-top:5px;
                text-align: center;
                font-size:10px;
            }
            @media print {
                @page  { 
                    width: 80mm;
                    margin: 0mm;
                }
            }

        </style>
    </head>
    <body><!-- window.print(); -->
        <div class="content">
            <div class="title">
                 <?php echo $this->app->get('app_title'); ?><br> <?php echo $this->app->get('address'); ?>           
            </div>
            <div class="head-desc">
                <div class="date"><?php echo date('d/m/Y H:i A') ?><br><?php echo invoice_number($get->payment_id); ?></div>
                <div class="user">Vicky Nitinegoro</div>
            </div>
            <div class="separate"></div>
            <div class="transaction">
                <table class="transaction-table" cellspacing="0" cellpadding="0">

                    <tr>
                      <td class='name' colspan="2"><?php echo $get->package_name; ?></td>
                      <td class='sell-price'><?php echo number_format($get->price); ?></td>  
                      <td class='final-price'><?php echo number_format($get->price); ?></td>
                    </tr>                    
<?php  
$total = $get->price + $get->tax_total;

$discout_price = ($total * $get->discount) / 100;
            
$grandtotal = $total - $discout_price;

$change = ($get->paid - $grandtotal); 
?>
                    <tr class="price-tr">
                      <td colspan="4"><div class="separate-line"></div></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="final-price">Tax PPN</td>
                        <td class="final-price"><?php echo number_format($get->tax_total); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="final-price">Discount</td>
                        <td class="final-price"><?php echo (!$get->discount) ? '0' : number_format($discout_price)." (".$get->discount."%)"; ?> </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="final-price">Total</td>
                        <td class="final-price"><?php echo number_format($grandtotal) ?></td>
                    </tr>

                    <tr>
                        <td colspan="3" class="final-price"> Paid</td>
                        <td class="final-price"><?php echo number_format($get->paid); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="final-price">Change</td>
                        <td class="final-price"><?php echo number_format($change); ?></td>
                    </tr>
                </table>
            </div>
            <div class="thanks">
                ~~~ Thank's ~~~
            </div>
            <div class="azost">
       <!--          www.teitramega.com -->
            </div>
        </div>
    </body>
</html>