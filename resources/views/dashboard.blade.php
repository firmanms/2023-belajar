<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     Hallo, {{ Auth::user()->name }}
                     <!-- Three columns -->
                     
                     @if (Auth::user()->role=='admin')

                        <div class="container" style="margin-top: 50px;">
                          <div class="card-deck">
                              <div class="card mb-4">
                                  @php
                                     $admin= \App\Models\User::where('role','admin')->get()->count();
                                     $member= \App\Models\User::where('role','member')->get()->count();
                                     $artikel= \App\Models\Artikel::get()->count();
                                     $komentar= \App\Models\Komentar::get()->count();
                                  @endphp
                                  <div class="card-body">
                                      <h1 class="card-text"><font size="6">Admin</font></h1>
                                      <h1 class="card-text"><font size="8">{{ $admin }}</font></h1>                                      
                                  </div>
                              </div>
                              <div class="card mb-4">
                                  
                                  <div class="card-body">
                                    <h1 class="card-text"><font size="6">Member</font></h1>
                                    <h1 class="card-text"><font size="8">{{ $member }}</font></h1>                                      
                                  </div>
                              </div>
                              <div class="w-100 d-none d-sm-block d-md-none"><!-- wrap every 2 on sm--></div>
                      
                      
                              <div class="card mb-4">
                                  
                                  <div class="card-body">
                                    <h1 class="card-text"><font size="6">Artikel</font></h1>
                                    <h1 class="card-text"><font size="8">{{ $artikel }}</font></h1>                                      
                                  </div>
                              </div>
                              <div class="card mb-4">
                                  
                                <div class="card-body">
                                  <h1 class="card-text"><font size="6">Komentar</font></h1>
                                  <h1 class="card-text"><font size="8">{{ $komentar }}</font></h1>                                      
                                </div>
                            </div>
                              
                              
                      
                          </div>
                      </div>
                  
                                               
                     @else
                     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                           <div class="p-6 text-gray-900 dark:text-gray-100">
                                <b>List Artikel</b>
                                <br>
                                @if ($message = Session::get('success'))
                                   <div class="alert alert-success">
                                   <p>{{ $message }}</p>
                                   </div>
                                @endif
                                
                                <!-- Three columns -->
                                <table class="table table-bordered data-table" id="datatable-crud">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Gambar</th>
                                         {{-- <th>Gambar</th> --}}
                                         <th>Judul</th>
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
                     @endif
                     
                    
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
  ajax: "{{ url('artikel_member') }}",
  columns: [
  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
  { data: 'image', name: 'image' },
  { data: 'judul', name: 'judul' },
  { data: 'tanggal', name: 'tanggal' },
  {data: 'action', name: 'action', orderable: false},
  ],
  order: [[0, 'desc']]
  });
  $('body').on('click', '.delete', function () {
  if (confirm("Delete Record?") == true) {
  var id = $(this).data('id');
  // ajax
  $.ajax({
  type:"POST",
  url: "{{ url('delete-artikel') }}",
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