# Swiss Peptides Labs Colombia — Respaldo Completo 100% 2026

Repositorio oficial con la copia de seguridad integral (código fuente, tema personalizado, plugins, activos multimedia y base de datos completa).

---

## 📦 Contenido del Respaldo

1. **`wp-content/themes/swiss-peptides-theme/`**:
   * Tema personalizado completo (Biotecnología Suiza / Estilo Clínico Premium).
   * Catálogo interactivo de 40 productos con dosis y precios mayoristas dinámicos.
   * Motor del carrito atómico con 0ms de latencia (`/?sp_ajax_cart=1`).
   * Calculadora clínica de reconstitución de péptidos.
   * Checkout personalizado con validación automática y selector de departamentos.
   * Pantalla de confirmación de pedido con botón universal de WhatsApp (`api.whatsapp.com/send`).

2. **`_database_backup/`**:
   * `peptidos_wp_full_backup.sql`: Dump completo de la base de datos MySQL/MariaDB con todas las tablas, productos, pedidos, metadatos y configuraciones.
   * `peptidos_wp_full_backup.sql.gz`: Versión comprimida.

3. **`wp-content/plugins/`**:
   * Todos los plugins activos de WooCommerce, seguridad y pasarelas.

4. **`wp-content/uploads/`**:
   * Todas las imágenes de productos generadas en alta resolución, banners y logotipos.

5. **`_server_config/`**:
   * Archivo de configuración de Nginx para el dominio `peptidossuizos.com`.

---

## 🚀 Restauración de la Base de Datos

```bash
mysql -u peptidos_wp -p peptidos_wp < _database_backup/peptidos_wp_full_backup.sql
```

---
*Generado automáticamente — Swiss Peptides Labs Colombia.*
