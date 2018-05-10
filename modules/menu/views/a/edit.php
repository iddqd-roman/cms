<?php
use yii\easyii\modules\menu\MenuAsset;

$this->title = Yii::t('easyii/menu', 'Edit menu');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>



<?php
MenuAsset::register($this);
$this->registerJs("var menu = new MyMENU.Menu({
	config: {
		setMysql: true,
		getMysql: true
	}

});", 4);?>

<div id="container-nav">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <!--<div class="container">-->

<!--            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">L</a>
            </div>-->

            <div id="navbar" class="navbar-collapse collapse pceuropa-menu">
                <ul id="left" class="nav navbar-nav"></ul>
                <!--<ul id="right" class="nav navbar-nav navbar-right"></ul>-->
                <ul id="right" class="hidden"></ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
    <!--<div class="row pull-right">Preview: <a id=''>Life</a> | <a id=''>Html</a> | <a id=''>Yii2 Array</a></div><br/>-->
</div>
<div id="inputsData" class="col-md-6 form-horizontal">
    <h4>Add element</h4>

    <div class="form-group">
        <label class="col-sm-3 control-label">Type</label>
        <div class="col-sm-7">
            <select id="type" class="form-control input-sm">
                <option value="link">Link</option>
                <option value="dropmenu">Dropdown menu</option>
                <option value="line">Line (divider)</option>
            </select>
        </div>
    </div>

    <div id="location-box" class="form-group">
        <label class="col-sm-3 control-label">Location</label>
        <div class="col-sm-8">
            <select id="location" class="form-control input-sm">
                <option value="left">Navbar Left</option>
                <option value="right">Navbar Right</option>
            </select>
        </div>
    </div>

    <div id="anchor-box" class="form-group">
        <label class="col-sm-3 control-label">Label</label>
        <div class="col-sm-8">
            <input id="label" type="text" class="form-control input-sm">
        </div>
    </div>

    <div id="url-box" class="form-group">
        <label class="col-sm-3 control-label">URL</label>
        <div class="col-sm-8">
            <input id="url" type="text" class="form-control input-sm">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-8">
            <button type="button" id="add" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Add</button>
        </div>
    </div>
</div>
<ul id="edit" class="col-md-2 well">Drop here to edit</ul>
<ul id="trash" class="col-md-2 well">Drop here to trash</ul>

