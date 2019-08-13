<?php
namespace PHPMaker2019\Crud_Admin;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$product_delete = new product_delete();

// Run the page
$product_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fproductdelete = currentForm = new ew.Form("fproductdelete", "delete");

// Form_CustomValidate event
fproductdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $product_delete->showPageHeader(); ?>
<?php
$product_delete->showMessage();
?>
<form name="fproductdelete" id="fproductdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($product_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $product_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($product_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($product->product_code->Visible) { // product_code ?>
		<th class="<?php echo $product->product_code->headerCellClass() ?>"><span id="elh_product_product_code" class="product_product_code"><?php echo $product->product_code->caption() ?></span></th>
<?php } ?>
<?php if ($product->product_name->Visible) { // product_name ?>
		<th class="<?php echo $product->product_name->headerCellClass() ?>"><span id="elh_product_product_name" class="product_product_name"><?php echo $product->product_name->caption() ?></span></th>
<?php } ?>
<?php if ($product->product_price->Visible) { // product_price ?>
		<th class="<?php echo $product->product_price->headerCellClass() ?>"><span id="elh_product_product_price" class="product_product_price"><?php echo $product->product_price->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$product_delete->RecCnt = 0;
$i = 0;
while (!$product_delete->Recordset->EOF) {
	$product_delete->RecCnt++;
	$product_delete->RowCnt++;

	// Set row properties
	$product->resetAttributes();
	$product->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$product_delete->loadRowValues($product_delete->Recordset);

	// Render row
	$product_delete->renderRow();
?>
	<tr<?php echo $product->rowAttributes() ?>>
<?php if ($product->product_code->Visible) { // product_code ?>
		<td<?php echo $product->product_code->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCnt ?>_product_product_code" class="product_product_code">
<span<?php echo $product->product_code->viewAttributes() ?>>
<?php echo $product->product_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product->product_name->Visible) { // product_name ?>
		<td<?php echo $product->product_name->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCnt ?>_product_product_name" class="product_product_name">
<span<?php echo $product->product_name->viewAttributes() ?>>
<?php echo $product->product_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product->product_price->Visible) { // product_price ?>
		<td<?php echo $product->product_price->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCnt ?>_product_product_price" class="product_product_price">
<span<?php echo $product->product_price->viewAttributes() ?>>
<?php echo $product->product_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$product_delete->Recordset->moveNext();
}
$product_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $product_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$product_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$product_delete->terminate();
?>
