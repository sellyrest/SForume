<table class="table table-bordered" id="content-user" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($user as $item)

        <tr>
            <td>{{ ($user->currentpage()-1) * $user->perpage() + $loop->index + 1 }}</td>
            <td>{{$item->fullname}}</td>
            <td>{{$item->username}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->nomor_telpon}}</td>
            <td>
                <button class="btn btn-outline-indigo" type="button">Edit</button>
                <button class="btn btn-outline-orange" type="button">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>