@foreach ($saved as $item)
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold role">{{ $item->topic->kategori->name }}</h6>
        </div>
        <div class="card-body">
            <img style="height :60px; " class="rounded-circle"
                src="{{ $item->topic->user->foto ? asset('img/profile/' . $item->topic->user->foto) : asset('img/profile/default_fp.jpg') }}"
                alt="">
            <h5 class="name">{{ $item->topic->user->fullname }}</h5>
            <p class="time">{{ date('d F Y', strtotime($item->updated_at)) }}</p>
            <h4 class="title">{{ $item->topic->title }}</h4>
            <p class="content">{{ $item->topic->content }}</p>
            <div class="text-center">
                <img src="{{ asset('img/' . $item->topic->image) }}" alt="" class="img-fluid">
            </div>


            <button class="p-2 justify-content-center my-3 btn-rspn">Add Response</button>
            <button class="p-2 justify-content-center my-3 btn-saved @if( user_saved(Auth::user()->id, $item->topic->id)) active @endif"  data-user="{{Auth::user()->id}}" data-topic="{{$item->topic->id}}">
                @if( !user_saved(Auth::user()->id, $item->topic->id))
                    Save
                @else
                    Saved
                @endif
            </button>
            <a href="{{ route('topic.show', Crypt::encrypt($item->topic->id)) }}" class="btn-allrespon float-right mb-3">see all response</a>
        </div>
    </div>
@endforeach
{{ $saved->appends($_GET)->links()}}
