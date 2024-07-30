
// URL of the CSV file and variable declaration
const csvUrl = 'https://raw.githubusercontent.com/Tanmaysinh-Gharia/Shopping-Portal/master/shopping/pincode/Pincode_30052019.csv';
var lines2;

// Function to fetch and convert CSV to JSON
async function fetchCsvAndConvertToJson(url) {
    let jsonData;
    try {
        const response = await fetch(url);
        const csvText = await response.text();
        
        // Parse CSV
        Papa.parse(csvText, {
            header: true,
            dynamicTyping: true,
            complete: function(results) {
                jsonData = results.data;
                // console.log('JSON Data:', jsonData);
            }
        });
    } catch (error) {
        console.error('Error fetching or parsing CSV:', error);
    }
    return jsonData;
}


async function preparing_object() {
    lines2 = "";
    let lines = await fetchCsvAndConvertToJson(csvUrl).then(data=> {lines2= data});
    lines = lines2;
    st_ct_pin = {};
    for (let i = 0; i < lines.length-1; i++) {
        const line = lines[i];
        if (line) {
            
            const fields = line;
            const state = fields['StateName'];
            let city = '';
            try {
                city = fields['District'].toUpperCase().replace(/\s+/g, '');
            } catch (error) {
                console.log(fields,i)
            }
            const pin = fields["Pincode"];
            if (st_ct_pin[state]) {
                if (st_ct_pin[state][city]) {
                    if (!st_ct_pin[state][city].includes(pin)) {
                        st_ct_pin[state][city].push(pin);
                    }
                } else {
                    st_ct_pin[state][city] = [pin];
                }
            } else {
                st_ct_pin[state] = { city : [pin] };
            }
        }
    }

    // Sort the states and cities
    const sortedStates = Object.keys(st_ct_pin).sort();
    var sortedStCtPin = {};
    sortedStates.forEach(state => {
        const cities = st_ct_pin[state];
        const sortedCities = Object.keys(cities).sort();
        sortedStCtPin[state] = {};
        sortedCities.forEach(city => {
            sortedStCtPin[state][city] = cities[city].sort();
        });
    });

    st_ct_pin = sortedStCtPin;
    console.log(st_ct_pin);
    return st_ct_pin;
    }
    var st_ct_pin = preparing_object();
    