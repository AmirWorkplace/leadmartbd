<section class="page-title-section">
  <div class="container">
      <div class="breadcrumb-title">Login</div>
      <ul class="breadcrumb-list">
          <li class="breadcrumb-item">
              <a class="breadcrumb-link" href="{{ Route('frontend.home') }}">
                  <span class="breadcrumb-text">Home</span>
              </a>
          </li>
          <li class="breadcrumb-item">
              <a class="breadcrumb-link {{ $active == 'customer' ? 'active' : '' }}" href="{{ Route('customer.login') }}">
                  <span class="breadcrumb-text">User Login</span>
              </a>
          </li>
          <li class="breadcrumb-item">
              <a class="breadcrumb-link {{ $active == 'reseller' ? 'active' : '' }}" href="{{ Route('reseller.login') }}">
                  <span class="breadcrumb-text">Reseller Login</span>
              </a>
          </li>
      </ul>
  </div>
</section>
