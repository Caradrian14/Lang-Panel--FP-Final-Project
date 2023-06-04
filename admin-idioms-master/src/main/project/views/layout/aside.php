<div class="flex justify-center">
    <button id="aside-toggle" class="block lg:hidden p-2 m-2 text-black bg-teal-500">Mostrar/ocultar menú</button>
</div>
<aside id="aside-menu" class="hidden md:block flex-initial w:auto lg:w-80 text-2xl text-center bg-teal-800">
    <nav>
        <ul>
            <a href="/?Controller=front&method=getAll">
                <li class="border-2 border-white bg-teal-500 px-12 hover:bg-teal-900 hover:text-white ease-in duration-300">
                    Ver Tags
                </li>
            </a>
            <a href="/?Controller=front&method=getLangListPage">
                <li class="border-2 border-white bg-teal-500 px-12 hover:bg-teal-900 hover:text-white ease-in duration-300">
                    Ver Idiomas
                </li>
            </a>
            <a href="/?Controller=front&method=goLanding">
                <li class="border-2 border-white bg-teal-500 px-12 hover:bg-teal-900 hover:text-white ease-in duration-300">
                    Ver Pagina
                </li>
            </a>
        </ul>
    </nav>
</aside>