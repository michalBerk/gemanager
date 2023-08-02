import pip._vendor.requests as requests

def fetch_diamond_details(api_key, report_number):
    url = 'https://api.reportresults.gia.edu/'  # Replace this with the actual GIA API endpoint
    headers = {
        'Authorization': f'{api_key}',
        'Content-Type': 'application/json'
    }
    query = f'''
    {{
      getReport(report_number: "{report_number}") {{
        report_date
        report_number
        report_type
        results {{
          ... on DiamondGradingReportResults {{
            shape_and_cutting_style
            measurements
            carat_weight
            color_grade
            color_origin
            color_distribution
            clarity_grade
            cut_grade
            polish
            symmetry
            fluorescence
            clarity_characteristics
            inscriptions
            report_comments
            proportions {{
                depth_pct
                table_pct
                crown_angle
                crown_height
                pavilion_angle
                pavilion_depth
                star_length
                lower_half
                girdle
                culet
                }}
          }}
        }}
      }}
    }}
    '''

    try:
        response = requests.post(url, json={'query': query}, headers=headers)
        if response.status_code == 200:
            return response.json()
        else:
            print(f"Error: Failed to fetch data. Status code: {response.status_code}")
    except requests.exceptions.RequestException as e:
        print(f"Error: {e}")

    return None

def print_diamond_details(diamond_data):
    if diamond_data and 'data' in diamond_data and 'getReport' in diamond_data['data']:
        report_data = diamond_data['data']['getReport']
        if report_data:
            results = report_data.get('results', {})
            if 'shape_and_cutting_style' in results:
                print(f"Shape and Cutting Style: {results['shape_and_cutting_style']}")
            if 'measurements' in results:
                print(f"Measurements: {results['measurements']}")
            if 'carat_weight' in results:
                print(f"Carat Weight: {results['carat_weight']}")
            if 'color_grade' in results:
                print(f"Color Grade: {results['color_grade']}")
            if 'color_origin' in results:
                print(f"Color Origin: {results['color_origin']}")
            if 'color_distribution' in results:
                print(f"Color Distribution: {results['color_distribution']}")
            if 'clarity_grade' in results:
                print(f"Clarity Grade: {results['clarity_grade']}")
            if 'cut_grade' in results:
                print(f"Cut Grade: {results['cut_grade']}")
            if 'polish' in results:
                print(f"Polish: {results['polish']}")
            if 'symmetry' in results:
                print(f"Symmetry: {results['symmetry']}")
            if 'fluorescence' in results:
                print(f"Fluorescence: {results['fluorescence']}")
            if 'clarity_characteristics' in results:
                print(f"Clarity Characteristics: {results['clarity_characteristics']}")
            if 'inscriptions' in results:
                print(f"Inscriptions: {results['inscriptions']}")
            if 'report_comments' in results:
                print(f"Report Comments: {results['report_comments']}")
            if 'proportions' in results:
                proportions = results['proportions']
                print("Proportions:")
                print(f" - Depth Percentage: {proportions['depth_pct']}")
                print(f" - Table Percentage: {proportions['table_pct']}")
                print(f" - Crown Angle: {proportions['crown_angle']}")
                print(f" - Crown Height: {proportions['crown_height']}")
                print(f" - Pavilion Angle: {proportions['pavilion_angle']}")
                print(f" - Pavilion Depth: {proportions['pavilion_depth']}")
                print(f" - Star Length: {proportions['star_length']}")
                print(f" - Lower Half: {proportions['lower_half']}")
                print(f" - Girdle: {proportions['girdle']}")
                print(f" - Culet: {proportions['culet']}")
        else:
            print("Error: No data received or invalid report number.")
    else:
        print("Error: Invalid API response.")

def main():
    api_key = 'd14d5d91-f293-470e-991a-cf08c76df37f'
    report_number = '2225737134'

    diamond_data = fetch_diamond_details(api_key, report_number)
    print_diamond_details(diamond_data)

if __name__ == "__main__":
    main()
