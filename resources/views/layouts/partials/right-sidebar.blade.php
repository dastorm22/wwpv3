<!-- ========== Right Sidebar Start ========== -->
<div class="side-bar right-bar nicescroll">
    <h4 class="text-center">Recent Orders</h4>

    <div id="recent-orders-loader" class="text-center">
        <i class="fa fa-circle-o-notch fa-spin"></i>
    </div>

    <div class="contact-list nicescroll">
        <ul id="recent-orders-placeholder" class="list-group recent-orders-list"></ul>
    </div>
</div>
<!-- ========== Right Sidebar End ========== -->

@push('templates')
<script id="recent-orders-template" type="text/x-handlebars-template">
    @{{#each this}}
    <li class="list-group-item">
        <a href="/orders/@{{ id }}">
            <span class="name">@{{ address }}</span>
            <i class="fa fa-circle status-@{{ status }}"></i>
        </a>
        <span class="clearfix"></span>
    </li>
    @{{/each}}
</script>
@endpush