<ul>
  @foreach ($subcategories as $subcategory)
    <li>
      <div class="category_name">
      <span class="name">{{ $subcategory->category_name }}</span>

    <!-- Action Buttons for Subcategory -->
    <div class="icon add" title="Add" data-id="{{ $subcategory->id }}">+</div>
    <div class="icon edit" title="Edit" data-id="{{ $subcategory->id }}">✎</div>
    <div class="icon status" title="Status" data-id="{{ $subcategory->id }}">✓</div>
    <div class="icon delete" title="Delete" data-id="{{ $subcategory->id }}">x</div>

      @if ($subcategory->subcategories->isNotEmpty())
        @include('category.subcategories', ['subcategories' => $subcategory->subcategories])
      @endif
    </li>
  @endforeach
</ul>
