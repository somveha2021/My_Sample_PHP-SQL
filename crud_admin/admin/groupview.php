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
$group_view = new group_view();

// Run the page
$group_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$group_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$group->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fgroupview = currentForm = new ew.Form("fgroupview", "view");

// Form_CustomValidate event
fgroupview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fgroupview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$group->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $group_view->ExportOptions->render("body") ?>
<?php
	foreach ($group_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $group_view->showPageHeader(); ?>
<?php
$group_view->showMessage();
?>
<form name="fgroupview" id="fgroupview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($group_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $group_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="group">
<input type="hidden" name="modal" value="<?php echo (int)$group_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($group->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $group_view->TableLeftColumnClass ?>"><span id="elh_group_id"><?php echo $group->id->caption() ?></span></td>
		<td data-name="id"<?php echo $group->id->cellAttributes() ?>>
<span id="el_group_id">
<span<?php echo $group->id->viewAttributes() ?>>
<?php echo $group->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($group->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $group_view->TableLeftColumnClass ?>"><span id="elh_group_name"><?php echo $group->name->caption() ?></span></td>
		<td data-name="name"<?php echo $group->name->cellAttributes() ?>>
<span id="el_group_name">
<span<?php echo $group->name->viewAttributes() ?>>
<?php echo $group->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($group->role->Visible) { // role ?>
	<tr id="r_role">
		<td class="<?php echo $group_view->TableLeftColumnClass ?>"><span id="elh_group_role"><?php echo $group->role->caption() ?></span></td>
		<td data-name="role"<?php echo $group->role->cellAttributes() ?>>
<span id="el_group_role">
<span<?php echo $group->role->viewAttributes() ?>>
<?php echo $group->role->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$group_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$group->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$group_view->terminate();
?>
