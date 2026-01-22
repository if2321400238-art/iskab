<nav x-data="{ open: false, profileOpen: false, rubrikOpen: false }"
     class="bg-gradient-to-r from-gray-800 to-gray-900 text-white"
     role="navigation"
     aria-label="Main navigation">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}"
               class="flex items-center font-bold text-2xl text-orange-400"
               aria-label="ISKAB Home">
                ISKAB
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">

                <a href="{{ route('home') }}"
                   class="px-4 py-2 font-semibold text-orange-400 hover:text-orange-300 transition">
                    Beranda
                </a>

                <!-- Profil Dropdown -->
                <div class="relative group">
                    <div class="px-4 py-2 font-semibold text-gray-300 hover:text-white flex items-center transition cursor-pointer pointer-events-none"
                        aria-haspopup="true">
                        Profil
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180"
                             fill="currentColor" viewBox="0 0 20 20"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div class="hidden group-hover:block absolute left-0 mt-2 w-48 bg-gray-700 rounded-lg shadow-xl z-50 pointer-events-auto">
                        <a href="{{ route('about.profil') }}"
                           class="block px-4 py-2 hover:bg-gray-600 rounded-t-lg">Profil Organisasi</a>
                        <a href="{{ route('about.korwil') }}"
                           class="block px-4 py-2 hover:bg-gray-600">Korwil</a>
                        <a href="{{ route('about.rayon') }}"
                           class="block px-4 py-2 hover:bg-gray-600 rounded-b-lg">Rayon</a>
                    </div>
                </div>

                <!-- Rubrik Dropdown -->
                <div class="relative group">
                    <div class="px-4 py-2 font-semibold text-gray-300 hover:text-white flex items-center transition cursor-pointer pointer-events-none"
                        aria-haspopup="true">
                        Rubrik
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180"
                             fill="currentColor" viewBox="0 0 20 20"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div class="hidden group-hover:block absolute left-0 mt-2 w-48 bg-gray-700 rounded-lg shadow-xl z-50 pointer-events-auto">
                        <a href="{{ route('posts.berita') }}"
                           class="block px-4 py-2 hover:bg-gray-600 rounded-t-lg">Berita</a>
                        <a href="{{ route('posts.pena-santri') }}"
                           class="block px-4 py-2 hover:bg-gray-600 rounded-b-lg">Pena Santri</a>
                    </div>
                </div>

                <a href="{{ route('gallery.index') }}" class="px-4 py-2 font-semibold text-gray-300 hover:text-white">Galeri</a>
                <a href="{{ route('download.index') }}" class="px-4 py-2 font-semibold text-gray-300 hover:text-white">Download</a>
                <a href="{{ route('data.index') }}" class="px-4 py-2 font-semibold text-gray-300 hover:text-white">Data</a>
            </div>

            <!-- Mobile Toggle -->
            <button @click="open = !open"
                    class="md:hidden text-gray-300"
                    aria-label="Toggle mobile menu"
                    aria-expanded="false"
                    :aria-expanded="open.toString()">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="md:hidden bg-gray-700">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Beranda</a>
            <a href="{{ route('about.profil') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Profil</a>
            <a href="{{ route('about.korwil') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Korwil</a>
            <a href="{{ route('about.rayon') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Rayon</a>
            <a href="{{ route('posts.berita') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Berita</a>
            <a href="{{ route('posts.pena-santri') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Pena Santri</a>
            <a href="{{ route('gallery.index') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Galeri</a>
            <a href="{{ route('download.index') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Download</a>
            <a href="{{ route('data.index') }}" class="block px-3 py-2 hover:bg-gray-600 rounded">Data</a>
        </div>
    </div>
</nav>
