@foreach ($soucategorys as $souscategory)

    <tr>
        <td>{{ $souscategory->id }}</td>
        <td>{{ $souscategory->category->category_name }}</td>
        <td>{{ $souscategory->souscategory_name }}</td>
        <td>

            <a type="button" data-toggle="modal" data-target="#update_categorie_model_{{ $souscategory->id }}"
                class="btn btn-sm bg-warning">
                <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;" alt="update_icon">
            </a>
        </td>
        <td>
            <button type="button" data-toggle="modal" data-target="#delete_category_{{ $souscategory->id }}"
                class="btn btn-sm btn-danger">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </td>
    </tr>
@endforeach
