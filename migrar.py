import pandas as pd
from sqlalchemy import create_engine, inspect
from sqlalchemy.engine import URL

# MySQL local
mysql_engine = create_engine("mysql+pymysql://root:@localhost:3306/proyecto-uno")

# Supabase (PostgreSQL), con URL.create no hace falta codificar la contraseña
pg_url = URL.create(
    drivername="postgresql+psycopg",
    username="postgres.ghpcpyrlfzeqisqfftjx",
    password="huevos123@123",
    host="aws-0-us-east-1.pooler.supabase.com",
    port=5432,
    database="postgres",
)
pg_engine = create_engine(pg_url)

# Lee los nombres reales de las tablas desde MySQL (evita errores de tipeo)
tablas = inspect(mysql_engine).get_table_names()
print("Tablas encontradas:", tablas)

for tabla in tablas:
    tabla = tabla.strip()
    print(f"Migrando tabla: {tabla}...")
    try:
        df = pd.read_sql(f"SELECT * FROM `{tabla}`", mysql_engine)
        df.to_sql(tabla, pg_engine, if_exists="append", index=False)
        print(f"¡Tabla {tabla} migrada con éxito! ({len(df)} filas)")
    except Exception as e:
        print(f"Error al migrar la tabla {tabla}: {e}")