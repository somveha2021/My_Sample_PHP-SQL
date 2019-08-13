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
$category_view = new category_view();

// Run the page
$category_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$category->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcategoryview = currentForm = new ew.Form("fcategoryview", "view");

// Form_CustomValidate event
fcategoryview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoryview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$category->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $category_view->ExportOptions->render("body") ?>
<?php
	foreach ($category_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $category_view->showPageHeader(); ?>
<?php
$category_view->showMessage();
?>
<form name="fcategoryview" id="fcategoryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="modal" value="<?php echo (int)$category_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($category->category_id->Visible) { // category_id ?>
	<tr id="r_category_id">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_category_id"><?php echo $category->category_id->caption() ?></span></td>
		<td data-name="category_id"<?php echo $category->category_id->cellAttributes() ?>>
<span id="el_category_category_id">
<span<?php echo $category->category_id->viewAttributes() ?>>
<?php echo $category->category_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_name"><?php echo $category->name->caption() ?></span></td>
		<td data-name="name"<?php echo $category->name->cellAttributes() ?>>
<span id="el_category_name">
<span<?php echo $category->name->viewAttributes() ?>>
<?php echo $category->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($category->icon->Visible) { // icon ?>
	<tr id="r_icon">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_icon"><?php echo $category->icon->caption() ?></span></td>
		<td data-name="icon"<?php echo $category->icon->cellAttributes() ?>>
<span id="el_category_icon">
<span<?php echo $category->icon->viewAttributes() ?>>
<?php echo $category->icon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($category->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_status"><?php echo $category->status->caption() ?></span></td>
		<td data-name="status"<?php echo $category->status->cellAttributes() ?>>
<span id="el_category_status">
<span<?php echo $category->status->viewAttributes() ?>>
<?php echo $category->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$category_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$category->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$category_view->terminate();
?>
