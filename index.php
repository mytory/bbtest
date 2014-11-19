<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>bbtest</title>
	<link rel="stylesheet" href="./bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="style.css"/>
</head>
<body><div class="container">
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <h2>Breakdown</h2>
            <form action="action.php" class="form bb-breakdown-form" method="post">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label for="content">content</label>
                    <input type="text" name="content" id="content" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">category</label>
                    <input type="text" name="category" id="category" class="form-control">
                </div>
                <div class="form-group">
                    <label for="amount">amount</label>
                    <input type="text" name="amount" id="amount" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date">date</label>
                    <input type="date" name="date" id="date" class="form-control" value="<?=date('Y-m-d')?>">
                </div>
                <input type="submit" value="submit" class="btn btn-primary"/>
            </form>
        </div>

        <div class="col-md-8 col-xs-12">
            <h2>List</h2>
            <ul class="bb-breakdown-collection  list-group"></ul>
        </div>
    </div>
</div>
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="./bower_components/underscore/underscore-min.js"></script>
<script src="./bower_components/backbone/backbone.js"></script>
<script src="./bower_components/momentjs/moment.js"></script>
<script src="./bower_components/jquery-serialize-object/jquery.serialize-object.js"></script>
<script src="script.js"></script>

<script type="text/template" class="template-breakdown"><?php include 'template/breakdown.html' ?></script>
</body>
</html>
