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
$countries_view = new countries_view();

// Run the page
$countries_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countries_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$countries->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcountriesview = currentForm = new ew.Form("fcountriesview", "view");

// Form_CustomValidate event
fcountriesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountriesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$countries->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $countries_view->ExportOptions->render("body") ?>
<?php
	foreach ($countries_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $countries_view->showPageHeader(); ?>
<?php
$countries_view->showMessage();
?>
<form name="fcountriesview" id="fcountriesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countries_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countries_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countries">
<input type="hidden" name="modal" value="<?php echo (int)$countries_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($countries->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $countries_view->TableLeftColumnClass ?>"><span id="elh_countries_id"><?php echo $countries->id->caption() ?></span></td>
		<td data-name="id"<?php echo $countries->id->cellAttributes() ?>>
<span id="el_countries_id">
<span<?php echo $countries->id->viewAttributes() ?>>
<?php echo $countries->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($countries->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $countries_view->TableLeftColumnClass ?>"><span id="elh_countries_name"><?php echo $countries->name->caption() ?></span></td>
		<td data-name="name"<?php echo $countries->name->cellAttributes() ?>>
<span id="el_countries_name">
<span<?php echo $countries->name->viewAttributes() ?>>
<?php echo $countries->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$countries_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$countries->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$countries_view->terminate();
?>
