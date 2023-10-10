


<section class="page-title-section">
  <div class="container">
      <div class="breadcrumb-title">Registration</div>
      <ul class="breadcrumb-list">
        <li class="breadcrumb-item">
            <a class="breadcrumb-link" href="{{ Route('frontend.home') }}">
                <span class="breadcrumb-text">Home</span>
            </a>
        </li>
        <li class="breadcrumb-item">
            <a class="breadcrumb-link {{ $active == 'customer' ? 'active' : '' }}" href="{{ Route('customer.register') }}">
                <span class="breadcrumb-text">User Registration</span>
            </a>
        </li>
        <li class="breadcrumb-item">
            <a class="breadcrumb-link {{ $active == 'reseller' ? 'active' : '' }}" href="{{ Route('reseller.register') }}">
                <span class="breadcrumb-text">Reseller Registration</span>
            </a>
        </li>
    </ul>
  </div>
</section>
<!-- End Page title Section -->
