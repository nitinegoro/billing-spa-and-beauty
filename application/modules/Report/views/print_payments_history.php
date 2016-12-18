<html>
 <head></head>
 <body onload="window.print()"> <!--  onload="window.print()" -->
   <div class="wrapper">
      <div class="header">
         <div class="big-title"><?php echo $this->app->get('app_title'); ?></div>
         <div class="small-title"><?php echo $this->app->get('address'); ?></div>
      </div>
   </div>
   <div class="content" style="margin-top: 5px;">
      <table style="margin-top: 10px; margin-bottom: 20px;">
         <tr>Transactions Report</tr>
      </table>
   </div>
   <div class="content">
      <table class="gridtable" width="100%">
      <thead>
        <tr class="mini-font">
          <th rowspan="2" width="50">No.</th>
          <th rowspan="2">ID</th>
          <th rowspan="2" width="130">Date</th>
          <th rowspan="2">Customer Name</th>
          <th width="300" colspan="2" class="text-center">Items</th>
          <th rowspan="2">Tax</th>
          <th rowspan="2">Discount</th>
          <th rowspan="2">Total</th>
          <th rowspan="2">Cashier</th>
        </tr>
        <tr class="mini-font">
          <th>Package</th>
          <th>Price</th>
        </tr>
      </thead>
         <tbody>
<?php  
// Start Loops
$no = 1;
$all_price = 0; $all_tax = 0; $all_discount = 0; $all_grandtotal = 0;
foreach($payments as $row) :
  $date = new DateTime($row->date);
  $total = $this->payment->total(
        array(
          'tax' => $row->tax_total,
          'discount' => $row->discount,
          'price' => $row->price
        )
      );
  $all_price += $row->price;
  $all_tax += $row->tax_total;
  $all_discount += $total['discount'];
  $all_grandtotal += $total['grandtotal'];
?>
        <tr>
          <td><?php echo $no++; ?>.</td>
          <td><?php echo invoice_number($row->payment_id); ?></td>
          <td><?php echo $date->format('d/m/Y '); ?></td>
          <td><?php echo $row->name; ?></td>
          <td><?php echo $row->package_name; ?></td>
          <td><?php echo number_format($row->price) ?></td>
          <td><?php echo number_format($row->tax_total); ?></td>
          <td><?php echo ($row->discount != FALSE) ? number_format($total['discount']) : '-';  ?></td>
          <td><?php echo number_format($total['grandtotal']) ?></td>
          <td><?php echo $row->full_name; ?></td>
          </td>
        </tr>
<?php  
endforeach;
?>
         </tbody>
      <thead>
        <tr>
          <th colspan="3">
            <small style="padding-left:20px;"><?php echo $num_payment; ?> records.</small>
          </th>
          <th colspan="2"><small class="pull-right">Total : </small></th>
          <th><?php echo number_format($all_price) ?></th>
          <th><?php echo number_format($all_tax) ?></th>
          <th><?php echo number_format($all_discount) ?></th>
          <th colspan="3"><?php echo number_format($all_grandtotal) ?></th>
        </tr>
      </thead>
      </table>
   </div>
 </body>
</html> 

<style>
   table { font-size:12px; font-family:'Arial'; }
   .header { width:100%; height:5%; text-align:center; font-weight:500;  }
   .big-title {  font-family:'Arial'; font-size:14px; letter-spacing:normal; }
   .small-title {  font-family:'Times New Roman'; font-size:13px; letter-spacing:normal; }
   .content { font-size:12px; font-family:'Arial'; margin-top:-20px;}
   .upper { text-transform: uppercase;  }
   .underline { text-decoration: underline; }
   .bold { font-weight:bold; }
   table.gridtable {
      border-width: 1px;
      border-color: black;
      border-collapse: collapse; 
      font-size:0.8em;
   }
   table.gridtable th {
      border-width: 1px;
      padding: 5px;
      border-style: solid;
      border-color: black;
   }
   table.gridtable td {
      border-width: 1px;
      padding: 5px;
      border-style: solid;
      border-color: black;
   }
</style>

