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
$employees_view = new employees_view();

// Run the page
$employees_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$employees->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var femployeesview = currentForm = new ew.Form("femployeesview", "view");

// Form_CustomValidate event
femployeesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$employees->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employees_view->ExportOptions->render("body") ?>
<?php
	foreach ($employees_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employees_view->showPageHeader(); ?>
<?php
$employees_view->showMessage();
?>
<form name="femployeesview" id="femployeesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($employees_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $employees_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="modal" value="<?php echo (int)$employees_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($employees->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_id"><?php echo $employees->id->caption() ?></span></td>
		<td data-name="id"<?php echo $employees->id->cellAttributes() ?>>
<span id="el_employees_id">
<span<?php echo $employees->id->viewAttributes() ?>>
<?php echo $employees->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_name"><?php echo $employees->name->caption() ?></span></td>
		<td data-name="name"<?php echo $employees->name->cellAttributes() ?>>
<span id="el_employees_name">
<span<?php echo $employees->name->viewAttributes() ?>>
<?php echo $employees->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->address->Visible) { // address ?>
	<tr id="r_address">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_address"><?php echo $employees->address->caption() ?></span></td>
		<td data-name="address"<?php echo $employees->address->cellAttributes() ?>>
<span id="el_employees_address">
<span<?php echo $employees->address->viewAttributes() ?>>
<?php echo $employees->address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->salary->Visible) { // salary ?>
	<tr id="r_salary">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_salary"><?php echo $employees->salary->caption() ?></span></td>
		<td data-name="salary"<?php echo $employees->salary->cellAttributes() ?>>
<span id="el_employees_salary">
<span<?php echo $employees->salary->viewAttributes() ?>>
<?php echo $employees->salary->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees->photo->Visible) { // photo ?>
	<tr id="r_photo">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_photo"><?php echo $employees->photo->caption() ?></span></td>
		<td data-name="photo"<?php echo $employees->photo->cellAttributes() ?>>
<span id="el_employees_photo">
<span<?php echo $employees->photo->viewAttributes() ?>>
<?php echo $employees->photo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$employees_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$employees->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$employees_view->terminate();
?>
