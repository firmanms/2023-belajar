<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Komentar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <b>List Komentar</b>
                     <br>
                     @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                        <p>{{ $message }}</p>
                        </div>
                     @endif
                     <br><br>
                     <!-- Three columns -->
                     <table class="table table-bordered data-table" id="datatable-crud">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Judul Artikel</th>
                              {{-- <th>Gambar</th> --}}
                              <th>Komentar</th>
                              <th>Tanggal</th>
                              <th width="100px">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                    
                </div>
            </div>
            
        </div>
    </div>
    
</x-app-layout>
<script type="text/javascript">
  $(document).ready( function () {
  $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  $('#datatable-crud').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ url('komentar') }}",
  columns: [
  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
  { data: 'judulartikel', name: 'judulartikel' },
  { data: 'komentar', name: 'komentar' },
  { data: 'tanggal', name: 'tanggal' },
  {data: 'action', name: 'action', orderable: false},
  ],
  order: [[0, 'desc']]
  });
  $('body').on('click', '.delete', function () {
  if (confirm("Delete Record?") == true) {
  var id = $(this).data('id');
  var artikel_id = $(this).data('artikel_id');
  // ajax
  $.ajax({
  type:"POST",
  url: "{{ url('delete-komentar') }}",
  data: { id: id},
  dataType: 'json',
  success: function(res){
  var oTable = $('#datatable-crud').dataTable();
  oTable.fnDraw(false);
  }
  });
  }
  });
  });
  </script>
{{-- <script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('listartikel') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'judul', name: 'judul'},
            {data: 'isi', name: 'isi'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script> --}}
