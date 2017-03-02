<!--

*
* *- *- *- *- *- *- MAMBOLETO Joomla! -* -* -* -* -* -*
* @version 2.0 RC1
* @author Fernando Soares
* @copyright Fernando Soares - http://www.fernandosoares.com.br/
* @date Julho, 2007
* @package Joomla! 1.1.12 e Virtuemart 1.0.13

Baseado no trabalho de 	Matheus Mendes e Pedro Müller ( contato@mambopros.net )
				Messuka ( messuka@messuka.com.br )
				Metasig http://www.metasig.com.br
*

-->


<table width="630" cellspacing="0" cellpadding="0" border="0">
<font size="2" face="%HTMLFONT%"><b>Instruções para impressão: </b><br><br>
<tr>
<td>
<ul>
  <script language="JavaScript">

  var app=navigator.appName;
  if(app.indexOf('Netscape') != -1) {      
      document.write("<li>Utilize os <font color='#FF0000'>Fontes definidos no ");
      document.write("documento em tamanho 12</font> (no menu Editar, selecionar Preferências, em seguida ");
      document.write("selecionar Fontes, definir o tamanho do Fonte Largura Variável como 12 e selecionar Usar ");
      document.write("Fontes do Documento...).</li>");                
  } else if(app.indexOf('Microsoft') != -1) { 
      document.write("<li><font SIZE='1' face='%HTMLFONT%'>Utilize </font>");
      document.write("<font face='%HTMLFONT%' size='1'><font color='#FF0000'>fontes de tamanho médio</font> ");
      document.write("(no menu Exibir, selecionar Tamanho do texto, Médio).</li>");
  }
  </script>

  <li>Imprimir em impressora jato de tinta ou laser em <font color="#FF0000">qualidade
  normal</font>. (não utilize qualidade rascunho).</li>
</ul>

<font size="2" face="%HTMLFONT%"><b>Instruções de pagamento: </b>
</font>
<ul>
<font size="1" face="%HTMLFONT%">
  <li>Caso não queira imprimir o boleto, ou prefira pagar pelo Home Banking (internet), utilize as seguintes informações:<br></li>
</font>
<font size="2" face="%HTMLFONT%">
  <li>Código digitável: <b>%LINHA%</b></li> 
  <li>Valor: <b>R$ %VDOC%</b></li> 
</ul>
</font>
</td>
</tr>
</table>
<br>
<table width="630" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td><img src="%BOLETO_IMAGE_URL%/logo.png" width="159" height="40">
    </td>   
    <td align="RIGHT" valign="BOTTOM">
    <div align="right">
    <font size="2" face="%HTMLFONT%"><b>RECIBO DO SACADO</b></font>
    </div>
    </td>
  </tr>
</table>
<table width="630" border="1" style="border-left: 0px; border-right: 0px; border-bottom: 0px; border-top: 0px;" cellspacing="0" cellpadding="2">
  <tr>
    <td width="250" align="left" valign="top" style="border-bottom: 0px; border-left: 0px;"><font face="%HTMLFONT%" size="1">Cedente:</font><br>
    <font size="1" face="%HTMLFONT%"><b>%CDTE%</b></font><br>
    </td>
    <td width="140" align="left" valign="top" style="border-bottom: 0px; border-left: 0px;">
    <div align="center"><font face="%HTMLFONT%" SIZE="1">Agência/Cod. Cedente</font><br>
    <font size="1" face="%HTMLFONT%"><b>%AGCOD%</b></font><br>
    </div>
    </td>
    <td width="123" align="left" valign="top" style="border-bottom: 0px; border-left: 0px;">
    <div align="center"><font face="%HTMLFONT%" SIZE="1">Data do Documento</font><br>
    <font size="1" face="%HTMLFONT%"><b>%DDOC%</b></font><br>
    </div>
    </td>
    <td width="108" align="right" valign="top" style="border-bottom: 0px; border-left: 0px; border-right: 0px;">
    <div align="center"><font face="%HTMLFONT%" SIZE="1">Vencimento<br>
    </font><font size="2" face="%HTMLFONT%"><b>%VCTO%</b></font><br>
    </div>
    </td>
  </tr>
</table>
<table width="630" border="1" style="border-left: 0px; border-right: 0px; border-bottom: 0px; border-top: 0px;" cellspacing="0" cellpadding="2">
  <tr>
    <td  valign="top" width="250" align="left" style="border-bottom: 0px; border-left: 0px;">
    <font face="%HTMLFONT%" SIZE="1">Sacado<br>
    </font><font size="1" face="%HTMLFONT%"><b>%SACADO%</b></font>
    </td>
    <td valign="top" width="140" align="left" style="border-bottom: 0px; border-left: 0px;">
    <font face="%HTMLFONT%" SIZE="1"> Número Documento<br>
    </font><font size="1" face="%HTMLFONT%"><b>%NDOC%</b></font><br>
    </td>
    <td valign="top" width="122" align="left" style="border-bottom: 0px; border-left: 0px;">
    <font face="%HTMLFONT%" SIZE="1"> Nosso Número<br>
    </font><font size="1" face="%HTMLFONT%"><b>%NNUM%</b></font><br>
    </td>
    <td valign="top" width="108" style="border-bottom: 0px; border-left: 0px; border-right: 0px;">
    <div align="center"><font face="%HTMLFONT%" SIZE="1">Valor do Documento<br>
    </font><font face="%HTMLFONT%" size="2"><b>%VDOC%</b></font><br>
    </div>
    </td>
  </tr>
</table>
<table width="630" border="1" cellspacing="0" cellpadding="2" style="border-left: 0px; border-right: 0px; border-bottom: 0px; border-top: 0px;">
  <tr>
    <td width="100%" align="left" style="border-left: 0px; border-right: 0px;">
    <font face="%HTMLFONT%" SIZE="1">Demonstrativo:<br>
    <b>%DEMONS1%<br>
    %DEMONS2%<br>
    %DEMONS3%<br>
    %DEMONS4%</b></font>
    </td>
  </tr>
</table>
<table width="630" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="100%" align="right"><b><font size="1" face="%HTMLFONT%">Autenticação mecânica</font></b><br>
    </td>
  </tr>
  <tr>
    <td width="100%" align="center">&nbsp;</td>
  </tr>
</table>
<table width="630" cellspacing="0" cellpadding="0" border="1" style="border-style: dashed; border-bottom: 1px; border-right: 0px; border-top: 1px; border-left: 0px;">
  <tr>
    <td style="border-style: dashed; border-right: 0px; border-top: 0px; border-left: 0px;">
    <div align="left">
    <b><i><font SIZE="1">Corte na linha abaixo</font></i></b>
    </div>
    </td>
  </tr>
</table>
<br>
<table width="630" cellspacing="0" cellpadding="0" border="1" style="border-bottom: 0px; border-top: 0px; border-left: 0px; border-right: 0px">
  <tr>
    <td width="37" style="border-left: 0px; border-right: 0px; border-bottom: 0px; border-top: 0px">
    <img src="%BOLETO_IMAGE_URL%/%BANKCODE%.gif" width="37" height="34" border="0" >
    </td>
    <td width="140" style="border-left: 0px; border-bottom: 0px; border-top: 0px">
    <div align="center">
    <b><font size="2" face="%HTMLFONT%">%BANK%</font></b>
    </div>
    </td>
    <td width="70" style="border-left: 0px; border-bottom: 0px; border-top: 0px">
    <div align="center">
    <b><font size="4" face="%HTMLFONT%">%BANKCODE%</font></b>
    </div>
    </td>
    <td valign="MIDDLE" width="420" nowrap style="border-left: 0px; border-right: 0px; border-bottom: 0px; border-top: 0px">
    <div align="center">
    <font size="2" face="%HTMLFONT%"><b>%LINHA%</b></font>
    </div>
    </td>
  </tr>
</table>
<table width="630" border="1" cellspacing="0" cellpadding="1" style="border-bottom: 0px; border-top: 0px; border-left: 0px; border-right: 0px;">
  <tr>
    <td valign="top" colspan="6" style="border-left: 0px; border-bottom: 0px; border-right: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr>
        <td valign="top" width="110"><font face="%HTMLFONT%" SIZE="1">Local de Pagamento:</font><br>
        </td>
      </tr>
      <tr>
        <b><td valign="top" align="center"><font size="1" face="%HTMLFONT%">%LP%</font></b><br>
        </td>
      </tr>
    </table>
    </td>
    <td width="150" style="border-right: 0px; border-bottom: 0px">
    <table cellspacing="0" cellpadding="1" height="100%" width="100%" border="0">
      <tr>
        <td>
        <font face="Arial" size="1">Vencimento</font><br>
        </td>
      </tr>
      <tr>
        <td align="RIGHT">
        <div align="center">
        <b><font face="%HTMLFONT%" size="2">%VCTO%</font></b><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="6" width="487" valign="top" style="border-left: 0px; border-bottom: 0px; border-right: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
        <font face="%HTMLFONT%" SIZE="1">Cedente</font><br>
        </td>
      </tr>
      <tr>
        <td valign="top">
        <b><font size="1" face="%HTMLFONT%">%CDTE%</font></b><br>
        </td>
      </tr>
    </table>
    </td>
    <td style="border-right: 0px; border-bottom: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr>
        <td><font face="%HTMLFONT%" SIZE="1">Agência/Código Cedente</font><br>
        </td>
      </tr>
      <tr>
        <td align="RIGHT">
        <div align="center">
        <b><font size="1" face="%HTMLFONT%">%AGCOD%</font></b><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width="120" style="border-left: 0px; border-bottom: 0px; border-right: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font face="%HTMLFONT%" SIZE="1">Data do documento:</font><br>
        </td>
      </tr>
      <tr>
        <td align="CENTER">
        <div align="center">
        <b><font size="1" face="%HTMLFONT%" >%DDOC%</font></b><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
    <td width="120" colspan="2" style="border-bottom: 0px; border-right: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr>
        <td>
        <font face="%HTMLFONT%" SIZE="1">No. do documento</font><br>
        </td>
      </tr>
      <tr>
        <td align="CENTER">
        <b><font size="1" face="%HTMLFONT%" >%NDOC%</font></b><br>
        </td>
      </tr>
    </table>
    </td>
    <td width="80" style="border-bottom: 0px; border-right: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
        <div align="center">
        <font face="%HTMLFONT%" SIZE="1">Espécie doc.</font><br>
        </div>
        </td>
      </tr>
      <tr>
        <td align="CENTER">
        <div align="center">
        <font size="1" face="%HTMLFONT%"><b>%EDOC%</b></font><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
    <td width="40" style="border-bottom: 0px; border-right: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
        <div align="center">
        <font face="%HTMLFONT%" SIZE="1">Aceite</font><br>
        </div>
        </td>
      </tr>
      <tr>
        <td align="CENTER">
        <div align="center">
        <b><font size="1" face="%HTMLFONT%" >N</font></b><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
    <td width="110" valign="top" style="border-bottom: 0px; border-right: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr>
        <td >
        <div align="center">
        <font face="%HTMLFONT%" SIZE="1">Data Processamento</font>
        </div>
        </td>
      </tr>
      <tr>
        <td align="CENTER">
        <div align="center">
<!--original        <b><font size="1" face="%HTMLFONT%" >%DDOC%</font></b> -->
        <b><font size="1" face="%HTMLFONT%" >%DPROC%</font></b>
        </div>
        </td>
      </tr>
    </table>
    </td>
    <td width="140" style="border-right: 0px; border-bottom: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
        <font face="%HTMLFONT%" SIZE="1">Nosso Número</font><br>
        </td>
      </tr>
      <tr>
        <td align="RIGHT">
        <div align="center">
        <b><font size="1" face="%HTMLFONT%" >%NNUM%</font></b><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width="110" valign="top" style="border-bottom: 0px; border-right: 0px; border-left: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
        <font face="%HTMLFONT%" SIZE="1">Uso do Banco</font><br>
        </td>
      </tr>
      <tr>
        <td align="CENTER">
        <b><font face="%HTMLFONT%" SIZE="1">%USOBC%</font></b><br>
        </td>
      </tr>
    </table>
    </td>
    <td width="38" valign="top" style="border-right: 0px; border-bottom: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
        <div align="center">
        <font face="%HTMLFONT%" SIZE="1">Carteira</font><br>
        </div>
        </td>
      </tr>
      <tr>
        <td align="CENTER">
        <div align="center">
        <b><font size="1" face="%HTMLFONT%">%CART%</font></b><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
    <td width="118" valign="top" style="border-right: 0px; border-bottom: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
        <div align="center">
        <font face="%HTMLFONT%" SIZE="1">Espécie da Moeda</font><br>
        </div>
        </td>
      </tr>
      <tr align="CENTER">
        <td>
        <div align="center">
        <b><font size="1" face="%HTMLFONT%" >%ESPMOED%&nbsp; </font></b><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
    <td width="90" colspan="2" valign="top" style="border-right: 0px; border-bottom: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr>
        <td valign="top">
        <font face="%HTMLFONT%" SIZE="1">Quantidade </font><br>
        </td>
      </tr>
      <tr>
        <td align="CENTER">
        <b><font face="%HTMLFONT%" SIZE="1">%QTDE%</font></b><br>
        </td>
      </tr>
    </table>
    </td>
    <td width="120" valign="top" style="border-right: 0px; border-bottom: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr>
        <td valign="top">
        <font face="%HTMLFONT%" SIZE="1">(x) Valor</font><br>
        </td>
      </tr>
      <tr>
        <td>
        <b><font face="%HTMLFONT%" SIZE="1">%VMOED%</font></b><br>
        </td>
      </tr>
    </table>
    </td>
    <td width="150" style="border-right: 0px; border-bottom: 0px">
    <table border="0" height="100%" width="100%" cellpadding="1" cellspacing="0">
      <tr>
        <td height="50%">
        <font face="%HTMLFONT%" SIZE="1">(=) Valor do Documento </font><br>
        </td>
      </tr>
      <tr>
        <td align="RIGHT" height="50%">
        <div align="center">
        <b><font face="%HTMLFONT%" SIZE="2">%VDOC%</font></b><br>
        </div>
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="6" valign="TOP" style="border-right: 0px; border-bottom: 0px; border-left: 0px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr valign="MIDDLE">
        <td height="23" valign="top">
        <font face="%HTMLFONT%" SIZE="1"><b>Instruções (Texto de responsabilidade do cedente) </b><br></font>
        </td>
      </tr>
      <tr valign="TOP">
        <td><font face="%HTMLFONT%" size="1">%INSTR1%<br>
        %INSTR2%<br>
        %INSTR3%<br>
        %INSTR4%<br>
        %INSTR5%</font>
        </td>
      </tr>
    </table>
    </td>
    <td style="border-right: 0px; border-bottom: 0px">
    <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-bottom: 0px; border-top: 0px; border-left: 0px; border-right: 0px;">
      <tr valign="TOP">
        <td height="23" style="border-right: 0px; border-top: 0px; border-left: 0px">
        <font face="%HTMLFONT%" SIZE="1">(-) Descontos/Abatimento <br>%DESC%</font>
        </td>
      </tr>
      <tr valign="TOP">
        <td height="23" style="border-right: 0px; border-top: 0px; border-left: 0px">
        <font face="%HTMLFONT%" SIZE="1">(-) Outras Deduções <br>%DDC%</font>
        </td>
      </tr>
      <tr valign="TOP">
        <td height="23" style="border-right: 0px; border-top: 0px; border-left: 0px">
        <font face="%HTMLFONT%" SIZE="1">(+) Mora/Multa <br>%MULTA%</font>
        </td>
      </tr>
      <tr valign="TOP">
        <td height="23" style="border-right: 0px; border-top: 0px; border-left: 0px">
        <font face="%HTMLFONT%" SIZE="1">(+) Outros Acréscimos <br>%ACRES%</font>
        </td>
      </tr>
      <tr valign="TOP">
        <td height="23" style="border-right: 0px; border-top: 0px; border-left: 0px; border-bottom: 0px">
        <font face="%HTMLFONT%" SIZE="1">(=) Valor Cobrado <br>%VCOBR%</font>
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="7" style="border-right: 0px; border-left: 0px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" width="100" style="border-top: 0px">
            <font face="%HTMLFONT%" SIZE="1">Sacado:&nbsp;</font><br>
          </td>
          <td width="100%" valign="top" rowspan="2">
            <font size="2" face="%HTMLFONT%" ><b>%SACADO%&nbsp;%CPF%</b></font><br><br>
          </td>
        </tr>
        
        <tr>
          <td colspan="2" width="100" style="border-top: 0px">
            <font face="%HTMLFONT%" SIZE="1">Sacador&nbsp;/&nbsp;Avalista:&nbsp;</font><br>
          </td>
        </tr>
        
        <tr>
          <td colspan="2" width="100" style="border-top: 0px">
            <font face="%HTMLFONT%" SIZE="1">Código de barras</font><br>
          </td>
        </tr>
        
      </table>
    </td>
  </tr>
</table>
<table width="630" cellspacing="0" cellpadding="1" border="0">
  <tr>
    <td align="left" width="490" nowrap>
<!--      <img src="%BOLETO_IMAGE_URL%espaco.gif" valign="bottom" border="0" height="5" width="5"><br>%BAR% -->
      <img src="%BOLETO_IMAGE_URL%espaco.gif" valign="bottom" border="0" height="5" width="5"><br>%BAR2%
    </td>
    <td valign="top" align="right" width="140">
      <div align="right" style="padding-left: 1px;">
      <b><font size="1" face="%HTMLFONT%" >Ficha de Compensação</font></b><br>
      <font face=%HTMLFONT% SIZE=1>Autenticação Mecânica</font>
      </div>
    </td>
  </tr>
</table>
<table width="630" cellspacing="0" cellpadding="0" border="1" style="margin-top: 4px; border-style: dashed; border-bottom: 0px; border-right: 0px; border-top: 0px; border-left: 0px; border-right: 0px;">
  <tr>
    <td colspan= 2 style="border-style: dashed; border-right: 0px; border-left: 0px; border-bottom: 0px;">
      <div align="left">
      <b><i><font SIZE="1">Corte na linha acima</font></i></b>
      </div>
    </td>
  </tr>
</table>