$(document).ready(function(){
    $('#add-btn').click(function(){
        var name = $('#todo-name').val();
        var category_id = $('#category').val();
        if(name.length === 0) {
            alert('Please enter a todo name.');
            return;
        }

        $.post('index.php?r=todo/create', {name: name, category_id: category_id}, function(data){
            if(data.success){
                var row = '<tr data-id="'+data.todo.id+'">' +
                    '<td class="todo-name">'+data.todo.name+'</td>' +
                    '<td>'+data.todo.category+'</td>' +
                    '<td>'+data.todo.timestamp+'</td>' +
                    '<td><button class="toggle-status-btn btn btn-warning">Incomplete</button></td>' +
                    '<td><button class="edit-btn btn btn-primary">Edit</button> <button class="delete-btn btn btn-danger">Delete</button></td>' +
                    '</tr>';
                $('#todo-table').append(row);
                $('#todo-name').val('');
            } else {
                alert('Failed to add todo.');
            }
        });
    });

    $(document).on('click', '.delete-btn', function(){
        var row = $(this).closest('tr');
        var id = row.data('id');
        $.post('index.php?r=todo/delete&id='+id, function(data){
            if(data.success){
                row.remove();
            } else {
                alert('Failed to delete todo.');
            }
        });
    });

    $(document).on('click', '.toggle-status-btn', function(){
        var btn = $(this);
        var row = btn.closest('tr');
        var id = row.data('id');
        $.post('index.php?r=todo/toggle-status&id='+id, function(data){
            if(data.success){
                btn.text(data.status ? 'Completed' : 'Incomplete');
            } else {
                alert('Failed to update status.');
            }
        });
    });

    $(document).on('click', '.edit-btn', function(){
        var row = $(this).closest('tr');
        var id = row.data('id');
        var nameCell = row.find('.todo-name');
        var currentName = nameCell.text();
        var newName = prompt('Edit todo name:', currentName);
        if(newName && newName.trim() !== ''){
            $.post('index.php?r=todo/update&id='+id, {name: newName}, function(data){
                if(data.success){
                    nameCell.text(data.name);
                } else {
                    alert('Failed to update todo.');
                }
            });
        }
    });
});
