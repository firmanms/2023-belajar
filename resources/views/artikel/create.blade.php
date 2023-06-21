<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
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
                     <b>Tambah Artikel</b>
                     @if(session('status'))
                    <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                    </div>
                    @endif

                        <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg" >
                            @csrf
                        <div class="flex flex-wrap -mx-3 mb-3">
                          <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Judul
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="judul" id="grid-first-name" type="text" placeholder="Judul Artikel">
                            @error('judul')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            
                          </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-3">
                          <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                              Isi
                            </label>
                            {{-- <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="isi" id="grid-password" type="password" placeholder="******************"> --}}
                            <textarea name="isi" class="form-control" name="summernote" id="summernote"></textarea>
                            @error('isi')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                              Gambar
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="gambar" id="grid-city" type="file" placeholder="Albuquerque">
                            @error('gambar')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                           </div>
                        </div>   
                        <a href="{{ route('artikel.create') }}" data-toggle="tooltip" data-original-title="Tambah" class="Tambah btn btn-success Tambah">
                            Tambah
                            </a>               
                        <button type="submit" class="Tambah btn btn-success">Submit</button>
                      </form>
                </div>
            </div>
            
        </div>
    </div>
    
</x-app-layout>
<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('#summernote').summernote({
          placeholder: 'Isi Artikel',
          tabsize: 2,
          height: 220,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ]
        });
      </script>

