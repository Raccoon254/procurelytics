<div class="drawer">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <!-- Page content here -->
    </div>
    <div class="z-40 drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <div class="menu p-4 w-64 h-full bg-base-200 text-base-content flex flex-col justify-center items-start">
            <!-- Sidebar content here -->
            <button class="btn btn-primary mb-4">
                <a href="{{ route('procurement.create') }}" >Create Procurement</a> 
            </button>
            <button class="btn btn-primary mb-4">
                <a href="{{ route('categories.index') }}" >Categories</a>
            </button>
            <button class="btn btn-primary mb-4">
                <a href="{{ route('spend.index') }}" >Spend Categories</a>
            </button>
            <button class="btn btn-primary mb-4">
                <a href="{{ route('procurement.success') }}" >Procurement Success</a>
            </button>
            <button class="btn btn-primary mb-4">
                <a href="{{ route('procurement-data') }}" >Procurement Data</a>
            </button>
            <button class="btn btn-primary mb-4">
                <a href="{{ route('visualize') }}" >Visualize</a>
            </button>
            <button class="btn btn-primary mb-4" >
                <a href="{{ route('procurement.show', ['procurement' => 'procurement_id']) }}" >Show Procurement</a>
            </button>
        </div>
    </div>
</div>
