# Corporate Housing Dallas - SEO WordPress Website

A high-performance, SEO-optimized WordPress theme for Corporate Housing Dallas with 1500+ programmatically generated pages targeting "corporate housing Dallas" and "furnished apartments Dallas".

## 🚀 Quick Start

### Prerequisites
- Docker and Docker Compose installed
- Git
- Basic knowledge of WordPress

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/zakidallas/CHTNEW.git
cd CHTNEW
```

2. **Start Docker containers**
```bash
docker-compose up -d
```

3. **Access the site**
- WordPress: http://localhost:8080
- phpMyAdmin: http://localhost:8081
  - Username: root
  - Password: rootpassword

4. **Complete WordPress installation**
- Navigate to http://localhost:8080
- Follow the WordPress installation wizard
- Site Title: "Corporate Housing Dallas"
- Username: (your choice)
- Password: (your choice)
- Email: (your email)

5. **Activate the theme**
- Go to Appearance > Themes
- Activate "Corporate Housing Dallas"

## 🔑 API Configuration

The site requires three API keys for full functionality:

1. **OpenAI API** - For content generation
2. **Pixabay API** - For royalty-free images
3. **Google Maps API** - For location maps

These are already configured in the `.env` file.

## 📄 Generated Pages

The theme automatically generates:

### Main Pages (2)
- `/furnished-apartments-dallas/`
- `/corporate-housing-dallas/`

### Neighborhood Pages (30+)
- `/furnished-apartments-dallas-uptown/`
- `/corporate-housing-downtown-dallas/`
- And 28+ more neighborhoods

### ZIP Code Pages (50)
- `/corporate-housing-dallas-75201/`
- `/furnished-apartments-dallas-75202/`
- Through 75250

### Service Combination Pages (600+)
- `/{service}-{location}-dallas/`
- Examples:
  - `/pet-friendly-furnished-apartments-uptown-dallas/`
  - `/luxury-corporate-housing-downtown-dallas/`
  - `/short-term-rentals-medical-district-dallas/`

### Long-tail Pages (100+)
- `/cheap-furnished-apartments-dallas/`
- `/luxury-corporate-housing-dallas/`
- `/pet-friendly-corporate-housing-dallas/`

## 🎯 SEO Features

- **Dynamic Meta Tags**: Unique titles and descriptions for each page
- **Schema Markup**: LocalBusiness, FAQPage, and Article schemas
- **XML Sitemap**: Auto-generated at `/sitemap.xml`
- **Mobile Optimization**: Responsive design with Core Web Vitals optimization
- **Internal Linking**: Automated contextual linking between related pages
- **Image Optimization**: WebP format with lazy loading

## 📊 Lead Capture

Every page includes a lead capture form with:
- Full Name
- Phone Number
- Email Address
- Moving Date
- Duration of Stay
- Price Range (starting from $2,500)

Leads are stored in the database and can be managed via the admin dashboard.

## 🛠️ Admin Dashboard

Access the CHT Dashboard from WordPress admin:

1. **Dashboard**: View lead statistics and generated pages count
2. **Content Generation**: Generate new pages on-demand
3. **Lead Management**: View and export captured leads
4. **Settings**: Check API status and configuration

## 🔧 Development

### Theme Structure
```
wp-content/themes/corporate-housing-dallas/
├── inc/
│   ├── core/           # Core functionality
│   ├── api/            # API integrations
│   ├── generators/     # Content generation
│   ├── seo/           # SEO optimizations
│   └── forms/         # Lead capture
├── assets/            # CSS, JS, Images
├── page-templates/    # Custom page templates
└── backup/           # Backup files and prompts
```

### Key Features
- Virtual page system for dynamic content
- Content caching (6 months)
- API rate limiting
- Automatic image optimization
- AJAX form submission
- Security headers

## 📈 Performance

- Page load time: < 3 seconds
- Core Web Vitals optimized
- CDN-ready
- Browser caching enabled
- Lazy loading for images

## 🔒 Security

- Input sanitization
- SQL injection prevention
- XSS protection
- API key encryption
- Regular security headers

## 📱 Mobile Optimization

- Responsive design
- Touch-optimized UI
- 48px minimum tap targets
- No horizontal scrolling
- Smooth animations

## 🎨 Design

Modern iOS/Android-inspired design with:
- Material Design components
- Smooth transitions
- Card-based layouts
- Sticky lead capture forms
- Clean typography

## 📞 Support

For issues or questions:
- Create an issue on GitHub
- Check the documentation in `/backup/prompts.md`

## 📄 License

Proprietary - All rights reserved

---

Built with ❤️ for Corporate Housing Travelers