<?php 
session_start();
require_once('db-connect.php');

$invoice_tbl_fields = ['invoice_code', 'customer', 'cashier', 'total_amount', 'discount_percentage', 'discount_amount', 'tendered_amount'];

$invoice_values = "";
foreach($_POST as $k => $v){
    if(!is_array($_POST[$k]) && in_array($k, $invoice_tbl_fields)){
        if(!empty($invoice_values)) $invoice_values .= ", ";
        $invoice_values .= " `{$k}` = '{$v}' ";
    }
}

if(!empty($invoice_values)){
    $invoice_qry = $conn->query("INSERT INTO `invoices_tbl` set {$invoice_values}");
    if($invoice_qry){
        $id = $conn->insert_id;
        $insert_batch_values = ""; 
        if(isset($_POST['item'])){
            foreach($_POST['item'] as $k => $v){
                if(!empty($insert_batch_values)) $insert_batch_values .= ", ";
                $insert_batch_values .= "('{$id}', '{$v}', '{$_POST['price'][$k]}', '{$_POST['qty'][$k]}', '{$_POST['unit'][$k]}', '{$_POST['total'][$k]}')";
            }
        }
        if(!empty($insert_batch_values)){
            $insert_batch_stmt = "INSERT INTO `invoice_meta_tbl` (`invoice_id`, `item`, `price`, `qty`, `unit`, `total`) VALUES {$insert_batch_values}";
            $insert_batch_qry = $conn->query($insert_batch_stmt);
            if($insert_batch_qry){
                $_SESSION['generate_receipt_id'] = md5($id);
                $resp['type'] = 'success';
                $resp['msg'] = "Invoice Data has been saved successfully!";
            }
            // Assuming you have an 'items_tbl' with columns 'item_code' and 'item_name'
// Modify the SQL query to fetch the item name based on the item code
if(isset($_POST['item'])){
    foreach($_POST['item'] as $k => $v){
        // Fetch the item name based on the item code
        $item_query = $conn->query("SELECT item_name FROM items_tbl WHERE item_code = '{$v}'");
        if($item_query && $item_query->num_rows > 0){
            $item_row = $item_query->fetch_assoc();
            $item_name = $item_row['item_name'];
        } else {
            // Set default item name if not found
            $item_name = 'Item Not Found';
        }

        if(!empty($insert_batch_values)) $insert_batch_values .= ", ";
        // Include item name along with other values in the batch insert query
        $insert_batch_values .= "('{$id}', '{$v}', '{$item_name}', '{$_POST['price'][$k]}', '{$_POST['qty'][$k]}', '{$_POST['unit'][$k]}', '{$_POST['total'][$k]}')";
    }
}

        }else{
            $resp['type'] = 'danger';
            $resp['msg'] = "An error occurred while saving Invoice Data!";
        }
    }else{
        $resp['type'] = 'danger';
        $resp['msg'] = "An error occurred while saving Invoice Data!";
    }

}else{
    $resp['type'] = 'danger';
    $resp['msg'] = "No Invoice Data sent!";
}

$_SESSION['flashdata'] = $resp;

$conn->close();
header("location: ./");
?>