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
$students_view = new students_view();

// Run the page
$students_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$students_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$students->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fstudentsview = currentForm = new ew.Form("fstudentsview", "view");

// Form_CustomValidate event
fstudentsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fstudentsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$students->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $students_view->ExportOptions->render("body") ?>
<?php
	foreach ($students_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $students_view->showPageHeader(); ?>
<?php
$students_view->showMessage();
?>
<form name="fstudentsview" id="fstudentsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($students_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $students_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="students">
<input type="hidden" name="modal" value="<?php echo (int)$students_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($students->stu_id->Visible) { // stu_id ?>
	<tr id="r_stu_id">
		<td class="<?php echo $students_view->TableLeftColumnClass ?>"><span id="elh_students_stu_id"><?php echo $students->stu_id->caption() ?></span></td>
		<td data-name="stu_id"<?php echo $students->stu_id->cellAttributes() ?>>
<span id="el_students_stu_id">
<span<?php echo $students->stu_id->viewAttributes() ?>>
<?php echo $students->stu_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($students->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $students_view->TableLeftColumnClass ?>"><span id="elh_students_name"><?php echo $students->name->caption() ?></span></td>
		<td data-name="name"<?php echo $students->name->cellAttributes() ?>>
<span id="el_students_name">
<span<?php echo $students->name->viewAttributes() ?>>
<?php echo $students->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($students->gender->Visible) { // gender ?>
	<tr id="r_gender">
		<td class="<?php echo $students_view->TableLeftColumnClass ?>"><span id="elh_students_gender"><?php echo $students->gender->caption() ?></span></td>
		<td data-name="gender"<?php echo $students->gender->cellAttributes() ?>>
<span id="el_students_gender">
<span<?php echo $students->gender->viewAttributes() ?>>
<?php echo $students->gender->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($students->bod->Visible) { // bod ?>
	<tr id="r_bod">
		<td class="<?php echo $students_view->TableLeftColumnClass ?>"><span id="elh_students_bod"><?php echo $students->bod->caption() ?></span></td>
		<td data-name="bod"<?php echo $students->bod->cellAttributes() ?>>
<span id="el_students_bod">
<span<?php echo $students->bod->viewAttributes() ?>>
<?php echo $students->bod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($students->pob->Visible) { // pob ?>
	<tr id="r_pob">
		<td class="<?php echo $students_view->TableLeftColumnClass ?>"><span id="elh_students_pob"><?php echo $students->pob->caption() ?></span></td>
		<td data-name="pob"<?php echo $students->pob->cellAttributes() ?>>
<span id="el_students_pob">
<span<?php echo $students->pob->viewAttributes() ?>>
<?php echo $students->pob->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$students_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$students->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$students_view->terminate();
?>
