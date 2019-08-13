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
$article_view = new article_view();

// Run the page
$article_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$article_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$article->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var farticleview = currentForm = new ew.Form("farticleview", "view");

// Form_CustomValidate event
farticleview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
farticleview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
farticleview.lists["x_category_id"] = <?php echo $article_view->category_id->Lookup->toClientList() ?>;
farticleview.lists["x_category_id"].options = <?php echo JsonEncode($article_view->category_id->lookupOptions()) ?>;
farticleview.lists["x_created_by"] = <?php echo $article_view->created_by->Lookup->toClientList() ?>;
farticleview.lists["x_created_by"].options = <?php echo JsonEncode($article_view->created_by->lookupOptions()) ?>;
farticleview.lists["x_status"] = <?php echo $article_view->status->Lookup->toClientList() ?>;
farticleview.lists["x_status"].options = <?php echo JsonEncode($article_view->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$article->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $article_view->ExportOptions->render("body") ?>
<?php
	foreach ($article_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $article_view->showPageHeader(); ?>
<?php
$article_view->showMessage();
?>
<form name="farticleview" id="farticleview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($article_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $article_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="article">
<input type="hidden" name="modal" value="<?php echo (int)$article_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($article->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $article_view->TableLeftColumnClass ?>"><span id="elh_article_id"><?php echo $article->id->caption() ?></span></td>
		<td data-name="id"<?php echo $article->id->cellAttributes() ?>>
<span id="el_article_id">
<span<?php echo $article->id->viewAttributes() ?>>
<?php echo $article->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($article->category_id->Visible) { // category_id ?>
	<tr id="r_category_id">
		<td class="<?php echo $article_view->TableLeftColumnClass ?>"><span id="elh_article_category_id"><?php echo $article->category_id->caption() ?></span></td>
		<td data-name="category_id"<?php echo $article->category_id->cellAttributes() ?>>
<span id="el_article_category_id">
<span<?php echo $article->category_id->viewAttributes() ?>>
<?php echo $article->category_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($article->title->Visible) { // title ?>
	<tr id="r_title">
		<td class="<?php echo $article_view->TableLeftColumnClass ?>"><span id="elh_article_title"><?php echo $article->title->caption() ?></span></td>
		<td data-name="title"<?php echo $article->title->cellAttributes() ?>>
<span id="el_article_title">
<span<?php echo $article->title->viewAttributes() ?>>
<?php echo $article->title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($article->detail->Visible) { // detail ?>
	<tr id="r_detail">
		<td class="<?php echo $article_view->TableLeftColumnClass ?>"><span id="elh_article_detail"><?php echo $article->detail->caption() ?></span></td>
		<td data-name="detail"<?php echo $article->detail->cellAttributes() ?>>
<span id="el_article_detail">
<span<?php echo $article->detail->viewAttributes() ?>>
<?php echo $article->detail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($article->photo->Visible) { // photo ?>
	<tr id="r_photo">
		<td class="<?php echo $article_view->TableLeftColumnClass ?>"><span id="elh_article_photo"><?php echo $article->photo->caption() ?></span></td>
		<td data-name="photo"<?php echo $article->photo->cellAttributes() ?>>
<span id="el_article_photo">
<span>
<?php echo GetFileViewTag($article->photo, $article->photo->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($article->created_by->Visible) { // created_by ?>
	<tr id="r_created_by">
		<td class="<?php echo $article_view->TableLeftColumnClass ?>"><span id="elh_article_created_by"><?php echo $article->created_by->caption() ?></span></td>
		<td data-name="created_by"<?php echo $article->created_by->cellAttributes() ?>>
<span id="el_article_created_by">
<span<?php echo $article->created_by->viewAttributes() ?>>
<?php echo $article->created_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($article->created_date->Visible) { // created_date ?>
	<tr id="r_created_date">
		<td class="<?php echo $article_view->TableLeftColumnClass ?>"><span id="elh_article_created_date"><?php echo $article->created_date->caption() ?></span></td>
		<td data-name="created_date"<?php echo $article->created_date->cellAttributes() ?>>
<span id="el_article_created_date">
<span<?php echo $article->created_date->viewAttributes() ?>>
<?php echo $article->created_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($article->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $article_view->TableLeftColumnClass ?>"><span id="elh_article_status"><?php echo $article->status->caption() ?></span></td>
		<td data-name="status"<?php echo $article->status->cellAttributes() ?>>
<span id="el_article_status">
<span<?php echo $article->status->viewAttributes() ?>>
<?php echo $article->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$article_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$article->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$article_view->terminate();
?>
