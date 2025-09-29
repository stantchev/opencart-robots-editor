/**
 * Robots.txt Editor & Cache Control Module for OpenCart 2.3.0.2
 *
 * Copyright (C) 2025  Станчев
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="<?php echo $entry_create; ?>" id="button-create" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $entry_create; ?></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $entry_clean; ?>" id="button-clean" class="btn btn-danger"><i class="fa fa-eraser"></i> <?php echo $entry_clean; ?></button>
        <button type="submit" id="button-save" form="form-robots" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-exclamation-triangle"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-robots" class="form-horizontal">
          <textarea id="text" name="robots" wrap="off" rows="15" class="form-control"><?php echo $text; ?></textarea>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#button-create').on('click', function() {
    $.ajax({
        url: 'index.php?route=extension/module/robots_editor/create_robots&token=<?php echo $token; ?>',
        dataType: 'text',
        success: function(res) { $('#text').val(res); }
    });
});
$('#button-clean').on('click', function() {
    $('#text').val('');
});
//--></script>
<?php echo $footer; ?>