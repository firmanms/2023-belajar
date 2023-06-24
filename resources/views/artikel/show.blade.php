
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <b>Lihat Artikel</b>
              @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
                </div>
              @endif
          </div>

          <div class="p-6 text-gray-900 dark:text-gray-100">
            <img src="{{ asset('storage/gambar/'.$artikel->gambar) }}" alt="" title="" width="100%">
            <font size="6"><b>{{ $artikel->judul }}</b></font><br><br>
            <h1>{!! $artikel->isi !!}</h1>
            <hr>
            <h1>Oleh : {!! $artikel->users->name !!}</h1>
          </div>

          <div class="p-6 text-gray-900 dark:text-gray-100">
            <form action="{{ url('/submitkomentar') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg" >
              @csrf
              <input type="hidden" name="id" value="{{ $artikel->id }}" class="form-control">
              <input type="hidden" name="parent_id" id="parent_id" class="form-control" >
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control" >
              <div>
                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="name">Balas Komentar</label>
                  <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="replyComment" type="text" readonly="true"  >
                  <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="name">Komentar</label>
                  <textarea class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" name="komentar" required="required" autofocus="autofocus"></textarea>
                  
                    @error('komentar')
                      <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>      
              <div class="flex items-center gap-4">
                  <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Komentar</button>
              </div>
            </form>
          </div>

          <div class="p-6 text-gray-900 dark:text-gray-100">
            List Komentar
              @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
              @endif
            @foreach ($artikel->komentars as $row) 
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              @php
              $iduser=$row->user_id;
              $nama_user= \App\Models\User::where('id',$iduser)->first();
              //  dd($nama_user);
              @endphp
                  <h5 class="ml-0 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><u>{{ $nama_user->name }}</u> :  {{ $row->komentar }}</h5>
                  <a href="javascript:void(0)" onclick="balasKomentar({{ $row->id }}, '{{ $row->komentar }}')"  class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Balas</a>
                  @foreach ($row->child as $val)
                  @php
                  $iduser2=$val->user_id;
                  $nama_user2= \App\Models\User::where('id',$iduser2)->first();
                  @endphp 
                  <h5 class="ml-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><u>{{ $nama_user2->name }}</u>  :  {{ $val->komentar }}</h5>
                  @endforeach
              
            </div>
            <br>
            @endforeach
           
          </div>
          
        </div>    
      </div>
    </div>
    
</x-app-layout>

<script>
  function balasKomentar(id, title) {
      $('#formReplyComment').show();
      $('#parent_id').val(id)
      $('#replyComment').val(title)
  }
</script>

