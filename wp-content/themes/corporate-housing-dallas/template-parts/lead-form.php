<div class="lead-form-wrapper">
    <form id="lead-form" class="lead-form">
        <h3>Get Your Quote Today!</h3>
        <p>Fill out the form below and we'll find the perfect furnished apartment for you.</p>
        
        <div class="form-group">
            <label for="full_name">Full Name *</label>
            <input type="text" id="full_name" name="full_name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="moving_date">Moving Date</label>
            <input type="date" id="moving_date" name="moving_date" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="duration_of_stay">Duration of Stay</label>
            <select id="duration_of_stay" name="duration_of_stay" class="form-control">
                <option value="">Select Duration</option>
                <option value="1-3 months">1-3 months</option>
                <option value="3-6 months">3-6 months</option>
                <option value="6-12 months">6-12 months</option>
                <option value="12+ months">12+ months</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="price_range">Price Range (Starting from $2,500)</label>
            <select id="price_range" name="price_range" class="form-control">
                <option value="">Select Price Range</option>
                <option value="$2,500-$3,500/month">$2,500 - $3,500/month</option>
                <option value="$3,500-$5,000/month">$3,500 - $5,000/month</option>
                <option value="$5,000-$7,500/month">$5,000 - $7,500/month</option>
                <option value="$7,500+/month">$7,500+/month</option>
            </select>
        </div>
        
        <input type="hidden" name="source_page" value="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
        
        <button type="submit" class="btn btn-primary btn-block">Get Instant Quote</button>
        
        <p class="form-note">✓ No obligation • ✓ 24/7 support • ✓ All-inclusive pricing</p>
    </form>
</div>