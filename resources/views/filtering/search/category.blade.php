@foreach ($categorys as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->domain->domain }}</td>
        <td>{{ $category->category_name }}</td>
        <td>

            <a type="button" data-toggle="modal" data-target="#update_categorie_model_{{ $category->id }}"
                class="btn btn-sm bg-warning">
                <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;" alt="update_icon">
            </a>
        </td>
        <td>
            <button type="button" data-toggle="modal" data-target="#delete_category_{{ $category->id }}"
                class="btn btn-sm btn-danger">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </td>
    </tr>
@endforeach
