<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJsFile('@web/js/todo.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="container p-5">
    <div class="row">
        <div class="col-12 col-lg-9 m-auto text-center">
<div class="card to-do-card px-4">
    <div class="card-body"></div>
<div class="card-title"><h1>To-do List</h1></div>

<div class="mb-3 input-group ">
    <select id="category" class="form-select-sm" >
        <option value="">All Categories</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category->id ?>" <?= ($selectedCategory == $category->id) ? 'selected' : '' ?>>
                <?= Html::encode($category->name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="text" id="todo-name" class="form-control border border-1 border-dark" placeholder="Type todo item name" aria-describedby="add-btn">
    <button type="button" id="add-btn" class="btn btn-success ">Add</button>
    </div>


<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Todo item name</th>
            <th>Category</th>
            <th>Timestamp</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="todo-table">
        <?php foreach ($todos as $todo): ?>
        <tr data-id="<?= $todo->id ?>">
            <td class="todo-name"><?= Html::encode($todo->name) ?></td>
            <td><?= Html::encode($todo->category->name) ?></td>
            <td><?= date('d M Y', strtotime($todo->timestamp)) ?></td>
            <td>
    <button class="toggle-status-btn btn btn-warning">
        
        <?= $todo->status ? 'Completed' : 'Incomplete' ?>
    </button>
</td>
            <td>
                <button class="edit-btn btn btn-primary">Edit</button>
                <button class="delete-btn btn btn-danger">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
    </div>
    </div>
</div>
<script>

</script>
