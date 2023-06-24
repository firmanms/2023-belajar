    @if (Auth::user()->role=='admin')
    <a href="{{ route('artikel.show',$artikel_id) }}" data-toggle="tooltip" data-original-title="Lihat" class="edit btn btn-info edit">
        Lihat
    </a>
    @else
    <a href="{{ route('artikel_member.show',$artikel_id) }}" data-toggle="tooltip" data-original-title="Lihat" class="edit btn btn-info edit">
        Lihat
        </a>
    @endif
    
    <a href="{{ route('komentar.edit',$id) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success edit">
    Ubah
    </a>
    <a href="javascript:void(0)" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
    Hapus
    </a>