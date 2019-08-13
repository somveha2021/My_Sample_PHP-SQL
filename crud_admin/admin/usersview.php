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
$users_view = new users_view();

// Run the page
$users_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$users->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fusersview = currentForm = new ew.Form("fusersview", "view");

// Form_CustomValidate event
fusersview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$users->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $users_view->ExportOptions->render("body") ?>
<?php
	foreach ($users_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $users_view->showPageHeader(); ?>
<?php
$users_view->showMessage();
?>
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?php echo (int)$users_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($users->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_id"><?php echo $users->id->caption() ?></span></td>
		<td data-name="id"<?php echo $users->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?php echo $users->id->viewAttributes() ?>>
<?php echo $users->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->username->Visible) { // username ?>
	<tr id="r_username">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_username"><?php echo $users->username->caption() ?></span></td>
		<td data-name="username"<?php echo $users->username->cellAttributes() ?>>
<span id="el_users_username">
<span<?php echo $users->username->viewAttributes() ?>>
<?php echo $users->username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->full_name->Visible) { // full_name ?>
	<tr id="r_full_name">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_full_name"><?php echo $users->full_name->caption() ?></span></td>
		<td data-name="full_name"<?php echo $users->full_name->cellAttributes() ?>>
<span id="el_users_full_name">
<span<?php echo $users->full_name->viewAttributes() ?>>
<?php echo $users->full_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_password"><?php echo $users->password->caption() ?></span></td>
		<td data-name="password"<?php echo $users->password->cellAttributes() ?>>
<span id="el_users_password">
<span<?php echo $users->password->viewAttributes() ?>>
<?php echo $users->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_created_at"><?php echo $users->created_at->caption() ?></span></td>
		<td data-name="created_at"<?php echo $users->created_at->cellAttributes() ?>>
<span id="el_users_created_at">
<span<?php echo $users->created_at->viewAttributes() ?>>
<?php echo $users->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->group_id->Visible) { // group_id ?>
	<tr id="r_group_id">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_group_id"><?php echo $users->group_id->caption() ?></span></td>
		<td data-name="group_id"<?php echo $users->group_id->cellAttributes() ?>>
<span id="el_users_group_id">
<span<?php echo $users->group_id->viewAttributes() ?>>
<?php echo $users->group_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$users_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$users->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$users_view->terminate();
?>
