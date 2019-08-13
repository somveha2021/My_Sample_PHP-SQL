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
$product_view = new product_view();

// Run the page
$product_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$product->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproductview = currentForm = new ew.Form("fproductview", "view");

// Form_CustomValidate event
fproductview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$product->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $product_view->ExportOptions->render("body") ?>
<?php
	foreach ($product_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $product_view->showPageHeader(); ?>
<?php
$product_view->showMessage();
?>
<form name="fproductview" id="fproductview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($product_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $product_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="modal" value="<?php echo (int)$product_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($product->product_code->Visible) { // product_code ?>
	<tr id="r_product_code">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_code"><?php echo $product->product_code->caption() ?></span></td>
		<td data-name="product_code"<?php echo $product->product_code->cellAttributes() ?>>
<span id="el_product_product_code">
<span<?php echo $product->product_code->viewAttributes() ?>>
<?php echo $product->product_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product->product_name->Visible) { // product_name ?>
	<tr id="r_product_name">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_name"><?php echo $product->product_name->caption() ?></span></td>
		<td data-name="product_name"<?php echo $product->product_name->cellAttributes() ?>>
<span id="el_product_product_name">
<span<?php echo $product->product_name->viewAttributes() ?>>
<?php echo $product->product_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product->product_price->Visible) { // product_price ?>
	<tr id="r_product_price">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_price"><?php echo $product->product_price->caption() ?></span></td>
		<td data-name="product_price"<?php echo $product->product_price->cellAttributes() ?>>
<span id="el_product_product_price">
<span<?php echo $product->product_price->viewAttributes() ?>>
<?php echo $product->product_price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$product_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$product->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$product_view->terminate();
?>
