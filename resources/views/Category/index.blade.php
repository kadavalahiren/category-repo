<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tree with Corner Action Icons</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- <style>
    .tree {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .tree ul {
      padding-top: 15px;
      position: relative;
      transition: all 0.5s;
    }

    .tree li {
      float: left;
      text-align: center;
      list-style-type: none;
      position: relative;
      padding: 20px 5px 0 5px;
    }

    .tree li::before, .tree li::after {
      content: '';
      position: absolute;
      top: 0;
      right: 50%;
      border-top: 1px solid #ccc;
      width: 50%;
      height: 20px;
    }

    .tree li::after {
      right: auto;
      left: 50%;
      border-left: 1px solid #ccc;
    }

    .tree li:only-child::after, .tree li:only-child::before {
      display: none;
    }

    .tree li:only-child {
      padding-top: 0;
    }

    .tree li:first-child::before, .tree li:last-child::after {
      border: 0 none;
    }

    .tree li:last-child::before {
      border-right: 1px solid #ccc;
      border-radius: 0 5px 0 0;
    }

    .tree li:first-child::after {
      border-radius: 5px 0 0 0;
    }

    .tree li div {
      border: 1px solid #ccc;
      padding: 10px;
      background: #fff;
      position: relative;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .tree li div:hover {
      background: #f0f8ff;
    }

    /* Corner icons */
    .icon {
      position: absolute;
      width: 20px;
      height: 20px;
      display: none;
      align-items: center;
      justify-content: center;
      background-color: #ddd;
      border-radius: 50%;
      font-size: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .icon:hover {
      background-color: #007bff;
      color: #fff;
    }

    .tree li div:hover .icon {
      display: flex;
    }

    /* Position each icon at a corner */
    .icon.add { position: absolute; top: -10px; left: -10px; } /* Top-left corner */
    .icon.edit { position: absolute; top: -10px; right: -10px; } /* Top-right corner */
    .icon.status { position: absolute; bottom: -10px; left: -10px; } /* Bottom-left corner */
    .icon.delete {  position: absolute; bottom: -10px; right: -10px; } /* Bottom-right corner */
  </style> -->

  <style>
  /* Main Tree Container */
  .tree {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .tree ul {
    padding-top: 15px;
    position: relative;
    display: flex;
    justify-content: center;
    transition: all 0.5s ease-in-out;
  }

  .tree li {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
  }

  /* Horizontal and Vertical Connector Lines */
  .tree li::before,
  .tree li::after {
    content: '';
    position: absolute;
    top: 0;
    width: 50%;
    height: 20px;
    border-top: 1px solid #ccc; /* Horizontal Line */
  }

  .tree li::before {
    right: 50%;
    border-right: 1px solid #ccc;
  }

  .tree li::after {
    left: 50%;
    border-left: 1px solid #ccc; /* Vertical Line */
  }

  /* First and Last Children */
  .tree li:first-child::before {
    border: none;
  }

  .tree li:last-child::after {
    border: none;
  }

  /* Vertical Connector for Parent to Children */
  .tree li ul::before {
    content: '';
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 20px;
    border-left: 1px solid #ccc;
  }

  /* Box Styling for Each Node */
  .tree li div {
    border: 1px solid #ccc;
    padding: 10px 20px;
    background: #fff;
    border-radius: 5px;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  /* Hover Effect for Nodes */
  .tree li div:hover {
    background: #f0f8ff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  /* Corner Icons */
  .icon {
    position: absolute;
    width: 20px;
    height: 20px;
    display: none;
    align-items: center;
    justify-content: center;
    background-color: #ddd;
    border-radius: 50%;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .icon:hover {
    background-color: #007bff;
    color: #fff;
  }

  /* Show Icons on Hover */
  .tree li div:hover .icon {
    display: flex;
  }

  /* Icon Positions */
  .icon.add { position: absolute; top: -10px; left: -10px; }      /* Top-left corner */
  .icon.edit { position: absolute; top: -10px; right: -10px; }    /* Top-right corner */
  .icon.status { position: absolute; bottom: -10px; left: -10px; } /* Bottom-left corner */
  .icon.delete { position: absolute; bottom: -10px; right: -10px; } /* Bottom-right corner */
</style>


</head>
<body>
  <div class="container mt-5">
    <div class="col-md-12">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add</a>
    </div>
    <div class="tree">
        <ul>
        @foreach ($categories as $category)
            <li>
                @if($category->parent_id == null)
                <div class="category_name">
                   <span class="name">{{ $category->category_name }}</span>
                   <input type="hidden" name="">
                    <!-- Action icons -->
                    <div class="icon add" title="Add" data-id="{{ $category->id }}">+</div>
                    <div class="icon edit" title="Edit" data-id="{{ $category->id }}">✎</div>
                    <div class="icon status" title="Status" data-id="{{ $category->id }}">✓</div>
                    <div class="icon delete" title="Delete" data-id="{{ $category->id }}">x</div>
                </div>
                @endif
                @if ($category->subcategories->isNotEmpty())
                    <ul>
                        @foreach ($category->subcategories as $subcategory)
                        <li>
                            <div class="category_name">
                                <!-- Display Subcategory Name -->
                                <span class="name">{{ $subcategory->category_name }}</span>

                                <!-- Action Buttons for Subcategory -->
                                <div class="icon add" title="Add" data-id="{{ $subcategory->id }}">+</div>
                                <div class="icon edit" title="Edit" data-id="{{ $subcategory->id }}">✎</div>
                                <div class="icon status" title="Status" data-id="{{ $subcategory->id }}">✓</div>
                                <div class="icon delete" title="Delete" data-id="{{ $subcategory->id }}">x</div>
                            </div>

                            <ul>
                            @foreach ($subcategory->subcategories as $subcategory)
                                <li>
                                    <div class="category_name">
                                        <span class="name">{{ $subcategory->category_name }}</span>

                                        <!-- Action Buttons for Subcategory -->
                                        <div class="icon add" title="Add" data-id="{{ $subcategory->id }}">+</div>
                                        <div class="icon edit" title="Edit" data-id="{{ $subcategory->id }}">✎</div>
                                        <div class="icon status" title="Status" data-id="{{ $subcategory->id }}">✓</div>
                                        <div class="icon delete" title="Delete" data-id="{{ $subcategory->id }}">x</div>
                                    </div>
                                    @if ($subcategory->subcategories->isNotEmpty())
                                        @include('category.subcategories', ['subcategories' => $subcategory->subcategories])
                                    @endif
                                </li>
                            @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
        </ul>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>

        // Add function
        $(document).on('click', '.add', function() {
            var parentId = $(this).data('id');
            var categoryName = prompt("Enter Category Name");

            if (categoryName) {
                $.ajax({
                url: '/categories/storeAjax', // Assuming route to store a new category
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    parent_id: parentId,
                    name: categoryName
                },
                success: function(response) {
                    console.log('response',response.status);

                    if (response.status) {
                        var newCategoryHtml = '<li><div class="name">' + categoryName +
                            '<div class="icon add" title="Add" data-id="' + response.category.id + '">+</div>' +
                            '<div class="icon edit" title="Edit" data-id="' + response.category.id + '">✎</div>' +
                            '<div class="icon status" title="Status" data-id="' + response.category.id + '">✓</div>' +
                            '<div class="icon delete" title="Delete" data-id="' + response.category.id + '">x</div>' +
                            '</div></li>';

                        $('ul[data-id="'+parentId+'"]').append(newCategoryHtml);
                        location.reload();
                    } else {
                        alert('Error adding category');
                    }
                }
                });
            }
        });

        // edit function
        $(document).on('click', '.edit', function() {
            var categoryId = $(this).data('id');
            var inputVal = $(this).closest('.category_name').find('.name');
            var currentName = $(this).closest('.category_name').find('.name').text().trim();
            var newCategoryName = prompt("Edit Category Name", currentName);

            if (newCategoryName && newCategoryName !== currentName) {
                $.ajax({
                    url: '/categories/' + categoryId,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: newCategoryName
                    },
                    success: function(response) {
                        console.log(response.status);

                        if (response.status == 'success') {
                            // Update the category name in the DOM
                            inputVal.text(newCategoryName);
                        } else {
                            alert('Error updating category');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating category:', error);
                        alert('An error occurred while updating the category');
                    }
                });
            }
        });

        // delete category
        $(document).on('click', '.delete', function() {
            console.log('check');

            var categoryId = $(this).data('id');

            if (confirm("Are you sure you want to delete this category?")) {
                $.ajax({
                url: '/categories/' + categoryId, // Assuming route for deleting category
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                    // Remove the category from the tree
                    $('[data-id="'+categoryId+'"]').closest('li').remove();
                    } else {
                    alert('Error deleting category');
                    }
                }
                });
            }
        });

        // Block category : status change
        $(document).on('click', '.status', function() {
            console.log('block is called');

            var categoryId = $(this).data('id');
            var status = 0;

            $.ajax({
                url: '/categories/' + categoryId + '/status', // Assuming route for updating category status
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        // Change the icon based on the new status
                        if (status === false) {
                            $(this).text('✖'); // Blocked state
                        } else {
                            $(this).text('✓'); // Active state
                        }
                    } else {
                        alert('Error changing category status');
                    }
                }
            });
        });

  </script>
</body>
</html>
