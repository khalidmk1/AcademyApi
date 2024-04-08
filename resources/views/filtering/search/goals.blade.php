@foreach ($goals as $goal)
    <tr>
        <td>{{ $goal->id }}</td>
        <td>{{ $goal->souscategory->souscategory_name }}</td>
        <td>{{ $goal->goals }}</td>
        <td>

            <a type="button" data-toggle="modal" data-target="#update_goal_model_{{ $goal->id }}"
                class="btn btn-sm bg-warning">
                <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;" alt="update_icon">
            </a>
        </td>
        <td>
            <button type="button" data-toggle="modal" data-target="#delete_goals_{{ $goal->id }}"
                class="btn btn-sm btn-danger">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </td>
    </tr>
@endforeach
