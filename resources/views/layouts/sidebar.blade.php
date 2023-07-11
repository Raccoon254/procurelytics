<div class="drawer">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <!-- Page content here -->
    </div>
    <div class="z-40 drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <div class="menu p-4 w-64 h-full bg-base-200 text-base-content flex flex-col justify-center items-start">
            <!-- Sidebar content here -->


            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('procurement.create') }}" >
                <i class="fa-solid fa-file-arrow-up"></i>
                <div class="">
                    Create Procurement
                </div>
            </a>

            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('categories.index') }}" >
                <i class="fa-solid fa-clipboard-list"></i>
                <div class="">
                    Categories
                </div>
            </a>

            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('procurement.create') }}" >
                <i class="fa-solid fa-file-arrow-up"></i>
                <div class="">
                    Spend Categories
                </div>
            </a>

            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('procurement.create') }}" >
                <i class="fa-solid fa-file-arrow-up"></i>
                <div class="">
                    visualize
                </div>
            </a>

            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('procurement.create') }}" >
                <i class="fa-solid fa-file-arrow-up"></i>
                <div class="">
                    Create Procurement
                </div>
            </a>

            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('procurement.create') }}" >
                <i class="fa-solid fa-file-arrow-up"></i>
                <div class="">
                    Create Procurement
                </div>
            </a>
            <button class="btn btn-gost mb-2 w-full">
                <a href="{{ route('categories.index') }}" >Categories</a>
            </button>
            <button class="btn btn-gost mb-2 w-full">
                <a href="{{ route('spend.index') }}" >Spend Categories</a>
            </button>
            <button class="btn btn-gost mb-2 w-full">
                <a href="{{ route('visualize') }}" >Visualize</a>
            </button>
            <button class="btn btn-gost mb-2 w-full" >
                <a href="{{ route('procurement.show', ['procurement' => 'procurement_id']) }}" >Show Procurement</a>
            </button>
        </div>
    </div>
</div>
