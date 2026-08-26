<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" 
    xmlns:html="http://www.w3.org/TR/REC-html40"
    xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
  <xsl:template match="/">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="es">
      <head>
        <title>Mapa del Sitio XML | Swiss Peptides Labs Colombia</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style type="text/css">
          body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            color: #0f172a;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
          }
          .header {
            background-color: #050b14;
            color: #ffffff;
            padding: 32px 20px;
            text-align: center;
            border-bottom: 4px solid #00a8ff;
          }
          .header h1 {
            margin: 0 0 8px 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
          }
          .header p {
            margin: 0;
            color: #94a3b8;
            font-size: 13px;
          }
          .container {
            max-width: 1080px;
            margin: 30px auto 60px;
            padding: 0 20px;
          }
          .stats-bar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 24px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(15,23,42,0.03);
          }
          .stats-count {
            font-weight: 700;
            color: #0284c7;
            font-size: 15px;
          }
          table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(15,23,42,0.04);
          }
          th {
            background: #0f172a;
            color: #ffffff;
            text-align: left;
            padding: 14px 18px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
          }
          td {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            vertical-align: middle;
          }
          tr:hover td {
            background-color: #f8fafc;
          }
          a {
            color: #0284c7;
            text-decoration: none;
            font-weight: 600;
          }
          a:hover {
            text-decoration: underline;
            color: #0369a1;
          }
          .badge-priority {
            background: #e0f2fe;
            color: #0369a1;
            padding: 4px 10px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 12px;
            display: inline-block;
          }
          .badge-high {
            background: #dcfce7;
            color: #15803d;
          }
          .img-preview {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            display: block;
          }
          .footer {
            text-align: center;
            color: #64748b;
            font-size: 12px;
            margin-top: 40px;
          }
        </style>
      </head>
      <body>
        <div class="header">
          <h1>SWISS PEPTIDES LABS COLOMBIA</h1>
          <p>Índice de Páginas y Productos Indexables para Google &amp; Motores de Búsqueda (Sitemap XML)</p>
        </div>
        <div class="container">
          <div class="stats-bar">
            <span class="stats-count">Total de URLs Indexadas: <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></span>
            <span style="font-size:13px;color:#64748b;">Protocolo sitemaps.org 0.9 &bull; Hreflang es-CO</span>
          </div>
          <table>
            <thead>
              <tr>
                <th style="width:40px;">#</th>
                <th style="width:50px;">Img</th>
                <th>URL Indexable</th>
                <th style="width:90px;text-align:center;">Prioridad</th>
                <th style="width:110px;text-align:center;">Frecuencia</th>
                <th style="width:120px;text-align:center;">Última Modificación</th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="sitemap:urlset/sitemap:url">
                <tr>
                  <td style="color:#94a3b8;font-weight:600;"><xsl:value-of select="position()"/></td>
                  <td>
                    <xsl:choose>
                      <xsl:when test="image:image/image:loc">
                        <img class="img-preview" src="{image:image/image:loc}" alt="Product" />
                      </xsl:when>
                      <xsl:otherwise>
                        <div style="width:44px;height:44px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:10px;font-weight:700;">WEB</div>
                      </xsl:otherwise>
                    </xsl:choose>
                  </td>
                  <td>
                    <a href="{sitemap:loc}" target="_blank"><xsl:value-of select="sitemap:loc"/></a>
                  </td>
                  <td style="text-align:center;">
                    <span class="badge-priority">
                      <xsl:if test="sitemap:priority &gt;= 0.95">
                        <xsl:attribute name="class">badge-priority badge-high</xsl:attribute>
                      </xsl:if>
                      <xsl:value-of select="sitemap:priority"/>
                    </span>
                  </td>
                  <td style="text-align:center;color:#64748b;font-weight:500;">
                    <xsl:value-of select="sitemap:changefreq"/>
                  </td>
                  <td style="text-align:center;color:#64748b;font-weight:600;font-size:12px;">
                    <xsl:value-of select="sitemap:lastmod"/>
                  </td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
          <div class="footer">
            &copy; 2026 Swiss Peptides Labs Colombia. Todos los derechos reservados.
          </div>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
