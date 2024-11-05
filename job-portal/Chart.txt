document.addEventListener('DOMContentLoaded', () => {
    const jobTableBody = document.querySelector('#jobTable tbody');
    
    // Check if advertData is populated
    if (advertData && Array.isArray(advertData)) {
        advertData.forEach(advert => {
            // Updated link to include company_ref
            const applyLink = `track_click.php?vacancy_ref=${encodeURIComponent(advert.vacancy_ref)}&company_ref=${encodeURIComponent(advert.company_ref)}`;
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${advert.company_ref}</td>
                <td>${advert.vacancy_ref}</td>
                <td>${advert.job_title}</td>
                
                <td><a href="${applyLink}" target="_blank" class="btn btn-success">Apply Now</a></td>
            `;
            jobTableBody.appendChild(row);
        });
    } else {
        jobTableBody.innerHTML = '<tr><td colspan="4">No job adverts found.</td></tr>';
    }
});


    // Chart Data
    document.addEventListener('DOMContentLoaded', () => {
        const jobTableBody = document.querySelector('#jobTable tbody');
        const ctx = document.getElementById('clickChart').getContext('2d');
        
        // Check and log vacancyRef
        const vacancyRef = advertData.length > 0 ? advertData[0].vacancy_ref : '';
        console.log("Using vacancyRef:", vacancyRef);
    
        if (!vacancyRef) {
            console.error("No vacancy_ref available for chart data fetch.");
            return; // Exit if vacancyRef is not available
        }
    
        fetch('chart_clicks.php?vacancy_ref=' + encodeURIComponent(vacancyRef))
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error("Error from API:", data.error);
                    return;
                }
    
                const labels = data.map(item => item.date);
                const clicks = data.map(item => item.clicks);
    
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Clicks per Day',
                            data: clicks,
                            borderColor: 'rgba(37, 111, 21)',
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            x: { title: { display: true, text: 'Date' } },
                            y: { title: { display: true, text: 'Clicks' } }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching click data:', error);
            });
    });
    
;
