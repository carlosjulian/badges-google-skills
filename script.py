import requests
from bs4 import BeautifulSoup
import json

url = 'https://www.cloudskillsboost.google/public_profiles/469d939a-02cd-4bfb-8d75-8d7f2eb9e8f9'
response = requests.get(url)
soup = BeautifulSoup(response.text, 'html.parser')

badges = soup.select('.profile-badge')
resultado = []

for badge in badges:
    # Extracción de datos
    name_element = badge.select_one('.ql-title-medium.l-mts')
    date_element = badge.select_one('.ql-body-medium.l-mbs')
    
    name = name_element.text.strip() if name_element else "Sin nombre"
    date = date_element.text.strip() if date_element else "Sin fecha"
    image = badge.select_one('img')['src'] if badge.select_one('img') else ""
    link = badge.select_one('a')['href'] if badge.select_one('a') else ""

    # Estructura JSON
    resultado.append({
        "nombre": name,
        "fecha_obtencion": date,
        "imagen_badge": image,
        "enlace_badge": link
    })

# Convertir a JSON con formato legible
json_output = json.dumps(resultado, indent=2, ensure_ascii=False)
print(json_output)

# Guardamos en un archivo JSON
with open('badges.json', 'w', encoding='utf-8') as f:
    f.write(json_output)
# El archivo badges.json contendrá la información extraída de las insignias.    
