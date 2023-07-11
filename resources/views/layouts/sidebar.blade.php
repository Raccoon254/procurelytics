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

            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('spend.index') }}" >
                <i class="fa-solid fa-file-arrow-up"></i>
                <div class="">
                    Spend Categories
                </div>
            </a>

            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('visualize') }}" >
                <i class="fa-solid fa-mountain"></i>
                <div class="">
                    Visualize
                </div>
            </a>

            <a class="flex gap-2 items-center hover:bg-accent p-2 rounded w-full bg-gray-200" href="{{ route('procurement-data') }}" >
                <i class="fa-solid fa-bag-shopping"></i>
                <div class="">
                    All Procurements
                </div>
            </a>
        </div>
    </div>
</div>
