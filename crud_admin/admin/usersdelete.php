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
$users_delete = new users_delete();

// Run the page
$users_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fusersdelete = currentForm = new ew.Form("fusersdelete", "delete");

// Form_CustomValidate event
fusersdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $users_delete->showPageHeader(); ?>
<?php
$users_delete->showMessage();
?>
<form name="fusersdelete" id="fusersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($users->id->Visible) { // id ?>
		<th class="<?php echo $users->id->headerCellClass() ?>"><span id="elh_users_id" class="users_id"><?php echo $users->id->caption() ?></span></th>
<?php } ?>
<?php if ($users->username->Visible) { // username ?>
		<th class="<?php echo $users->username->headerCellClass() ?>"><span id="elh_users_username" class="users_username"><?php echo $users->username->caption() ?></span></th>
<?php } ?>
<?php if ($users->full_name->Visible) { // full_name ?>
		<th class="<?php echo $users->full_name->headerCellClass() ?>"><span id="elh_users_full_name" class="users_full_name"><?php echo $users->full_name->caption() ?></span></th>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
		<th class="<?php echo $users->password->headerCellClass() ?>"><span id="elh_users_password" class="users_password"><?php echo $users->password->caption() ?></span></th>
<?php } ?>
<?php if ($users->created_at->Visible) { // created_at ?>
		<th class="<?php echo $users->created_at->headerCellClass() ?>"><span id="elh_users_created_at" class="users_created_at"><?php echo $users->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($users->group_id->Visible) { // group_id ?>
		<th class="<?php echo $users->group_id->headerCellClass() ?>"><span id="elh_users_group_id" class="users_group_id"><?php echo $users->group_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$users_delete->RecCnt = 0;
$i = 0;
while (!$users_delete->Recordset->EOF) {
	$users_delete->RecCnt++;
	$users_delete->RowCnt++;

	// Set row properties
	$users->resetAttributes();
	$users->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$users_delete->loadRowValues($users_delete->Recordset);

	// Render row
	$users_delete->renderRow();
?>
	<tr<?php echo $users->rowAttributes() ?>>
<?php if ($users->id->Visible) { // id ?>
		<td<?php echo $users->id->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_id" class="users_id">
<span<?php echo $users->id->viewAttributes() ?>>
<?php echo $users->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->username->Visible) { // username ?>
		<td<?php echo $users->username->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_username" class="users_username">
<span<?php echo $users->username->viewAttributes() ?>>
<?php echo $users->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->full_name->Visible) { // full_name ?>
		<td<?php echo $users->full_name->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_full_name" class="users_full_name">
<span<?php echo $users->full_name->viewAttributes() ?>>
<?php echo $users->full_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
		<td<?php echo $users->password->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_password" class="users_password">
<span<?php echo $users->password->viewAttributes() ?>>
<?php echo $users->password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->created_at->Visible) { // created_at ?>
		<td<?php echo $users->created_at->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_created_at" class="users_created_at">
<span<?php echo $users->created_at->viewAttributes() ?>>
<?php echo $users->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->group_id->Visible) { // group_id ?>
		<td<?php echo $users->group_id->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_group_id" class="users_group_id">
<span<?php echo $users->group_id->viewAttributes() ?>>
<?php echo $users->group_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$users_delete->Recordset->moveNext();
}
$users_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$users_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$users_delete->terminate();
?>
