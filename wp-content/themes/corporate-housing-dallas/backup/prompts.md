# Corporate Housing Dallas - SEO Prompts & Documentation

## Core SEO Strategy

### Primary Keywords
- **Main**: corporate housing Dallas, furnished apartments Dallas
- **Long-tail**: 
  - Pet-friendly furnished apartments Uptown Dallas
  - Short-term furnished rentals Dallas
  - Month-to-month furnished rentals Dallas
  - Executive corporate housing Dallas
  - Medical District corporate housing Dallas
  - Dallas healthcare professionals temporary housing

### Content Generation Prompts

#### Neighborhood Page Prompt
```
Write a comprehensive 1500-word guide about {service} in {neighborhood} Dallas. Include:

1. Introduction highlighting the benefits of {service} in this specific area
2. Overview of {neighborhood} including:
   - Character and atmosphere
   - Demographics and typical residents
   - Key landmarks and attractions
   - Distance to major business districts
   - Public transportation options

3. Why Choose {service} in {neighborhood}:
   - Proximity to major employers
   - Local amenities (restaurants, shopping, entertainment)
   - Safety and walkability
   - Community features

4. Types of {service} Available:
   - Studio apartments
   - One-bedroom units
   - Two-bedroom units
   - Luxury options
   - Pet-friendly options

5. What's Included:
   - Fully furnished details
   - Kitchen equipment
   - Utilities (electricity, water, internet)
   - Housekeeping options
   - Parking availability

6. Pricing Information:
   - Average monthly rates
   - Factors affecting pricing
   - Comparison to unfurnished options
   - Value proposition

7. Local Area Guide:
   - Top 5 restaurants within walking distance
   - Nearest grocery stores
   - Healthcare facilities
   - Fitness centers and parks
   - Entertainment venues

8. Transportation:
   - Distance to DFW Airport
   - Distance to Love Field
   - Major highways access
   - Public transit options
   - Average commute times to business districts

9. Perfect For:
   - Business travelers
   - Medical professionals
   - Relocating families
   - Insurance claims
   - Project-based workers

10. Conclusion with call to action

Make the content informative, locally relevant, and naturally incorporate related keywords. Write in a professional yet conversational tone.
```

#### ZIP Code Page Prompt
```
Create a 1000-word guide for {service} in Dallas ZIP code {zipcode}. Include:

1. Introduction to the {zipcode} area
2. Neighborhoods within this ZIP code
3. Major employers and businesses
4. Transportation and commute information
5. Local amenities and attractions
6. Types of furnished housing available
7. Pricing ranges and value proposition
8. Who this area is perfect for
9. Why choose our {service}
10. Call to action

Focus on practical information that helps decision-making. Include specific street names, business names, and local landmarks for authenticity.
```

#### FAQ Generation Prompt
```
Generate 10 frequently asked questions about {service} in {location} Dallas. For each question, provide a comprehensive 100-150 word answer. Questions should cover:

1. Pricing and what's included
2. Minimum stay requirements
3. Pet policies
4. Parking availability
5. Application process
6. Utilities and bills
7. Housekeeping services
8. Lease flexibility
9. Location-specific amenities
10. Move-in/move-out process

Answers should be specific to Dallas and the location when relevant. Include actual price ranges, specific policies, and local details.
```

## Page Structure Templates

### Meta Title Templates
- **Neighborhood**: {Service} in {Neighborhood} Dallas | Up to 50% Off Hotels
- **ZIP Code**: {Service} {ZIP} Dallas TX | Corporate & Short-Term Rentals
- **Service**: {Service} Dallas | Premium Furnished Apartments & Housing
- **Long-tail**: {Modifier} {Service} Dallas | Flexible Terms & Amenities

### Meta Description Templates
- **Neighborhood**: Premium {service} in {neighborhood} Dallas. Fully furnished, flexible terms, all-inclusive pricing. Pet-friendly options available. Book today!
- **ZIP Code**: Find {service} in Dallas {zipcode}. Perfect for business travelers, relocations, and extended stays. All utilities included. 24/7 support.
- **Service**: Looking for {service} in Dallas? We offer fully furnished apartments with flexible lease terms, premium amenities, and locations throughout DFW.

## Schema Markup Templates

### LocalBusiness Schema
```json
{
  "@context": "https://schema.org",
  "@type": "ApartmentComplex",
  "name": "{Service} in {Location} Dallas",
  "description": "Premium {service} offering fully furnished apartments with flexible lease terms in {location} Dallas.",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "{Location}",
    "addressRegion": "TX",
    "addressCountry": "US",
    "postalCode": "{ZIP}"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "{LAT}",
    "longitude": "{LNG}"
  },
  "telephone": "+1-XXX-XXX-XXXX",
  "url": "https://www.corporatehousingtravelers.com/{url}",
  "priceRange": "$$$",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "127"
  }
}
```

### FAQPage Schema
```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "{Question}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{Answer}"
      }
    }
  ]
}
```

## Content Variations

### Service Types
1. Corporate Housing
2. Furnished Apartments
3. Short-Term Rentals
4. Extended-Stay Suites
5. Luxury Furnished Housing
6. Monthly Furnished Rentals
7. Pet-Friendly Corporate Rentals
8. Utilities-Included Apartments
9. Temporary Housing for Relocation
10. Executive Rentals
11. Medical Stay Housing
12. Insurance Claim Housing
13. Remote Work-Friendly Housing
14. Serviced Apartments

### Neighborhoods (30)
1. Uptown
2. Downtown
3. Medical District
4. Deep Ellum
5. Bishop Arts
6. Oak Lawn
7. Knox-Henderson
8. Lower Greenville
9. Victory Park
10. Design District
11. Trinity Groves
12. Lakewood
13. M Streets
14. Preston Hollow
15. Highland Park
16. University Park
17. Oak Cliff
18. East Dallas
19. West End
20. Arts District
21. Cedars
22. Exposition Park
23. Kessler Park
24. Lake Highlands
25. Far North Dallas
26. Pleasant Grove
27. South Dallas
28. Vickery Meadow
29. Casa Linda
30. White Rock

### Target Audiences
1. Business travelers
2. Traveling healthcare professionals
3. Corporate executives
4. Relocation employees
5. Insurance claim/displacement clients
6. Government contractors
7. Digital nomads
8. Tech consultants
9. Film and entertainment crew
10. Military personnel (TDY)
11. International assignees
12. Graduate students/professors
13. Construction project managers
14. Startup founders
15. Legal professionals
16. Travel nurses

## API Integration Notes

### OpenAI API
- Model: GPT-4
- Rate limit: 100 requests/minute
- Content length: 1000-1500 words per page
- Temperature: 0.7 for variety
- Cache responses for 6 months

### Pixabay API
- Search queries: "{location} Dallas apartment", "{location} Dallas skyline"
- Image requirements: 
  - Minimum 1200px width
  - Landscape orientation preferred
  - 3-5 images per page
- Alt text format: "{Service} in {Location} Dallas - {Description}"

### Google Maps API
- Embed maps for each neighborhood
- Show nearby amenities
- Calculate distances to airports and business districts

## Performance Targets
- LCP: < 2.5 seconds
- FID: < 100 milliseconds  
- CLS: < 0.1
- Page size: < 1MB
- Time to Interactive: < 3.5 seconds

## Backup Strategy
- Database: Daily automated backups
- Content cache: Weekly backups
- Lead data: Real-time replication
- Code: Git version control
- Images: CDN with local backup

## Recovery Procedures
1. Database corruption: Restore from latest SQL backup
2. Content loss: Regenerate from prompts using OpenAI
3. API failure: Use cached content (6-month retention)
4. Server failure: Docker container restart
5. Theme issues: Restore from Git repository

---
Last Updated: 2025-06-23
Version: 1.0.0