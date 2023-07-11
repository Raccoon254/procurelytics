<div class="drawer">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <!-- Page content here -->
    </div>
    <div class="z-40 drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu p-4 w-64 h-full bg-base-200 text-base-content flex flex-col justify-center items-center">
            <!-- Sidebar content here -->
            <li>
                <a href="{{ route('procurement.create') }}" class="btn btn-primary mb-4">Create Procurement</a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}" class="btn btn-primary mb-4">Categories</a>
            </li>
            <li>
                <a href="{{ route('spend.index') }}" class="btn btn-primary mb-4">Spend Categories</a>
            </li>
            <li>
                <a href="{{ route('procurement.success') }}" class="btn btn-primary mb-4">Procurement Success</a>
            </li>
            <li>
                <a href="{{ route('procurement-data') }}" class="btn btn-primary mb-4">Procurement Data</a>
            </li>
            <li>
                <a href="{{ route('visualize') }}" class="btn btn-primary mb-4">Visualize</a>
            </li>
            <li>
                <a href="{{ route('procurement.show', ['procurement' => 'procurement_id']) }}" class="btn btn-primary mb-4">Show Procurement</a>
            </li>
        </ul>
    </div>
</div>
