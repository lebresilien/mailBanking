/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function getXMLHttp() 
{
        var xhr = null;
        if (window.XMLHttpRequest) 
        {
        
            try 
            {
            
               xhr = new XMLHttpRequest();
            } 
            catch(e)
            { 
            
            }
        }
        else if (window.ActiveXObject) 
        {
        
             try 
             {
                 xhr = new ActiveXObject("Msxml2.XMLHTTP");
             }catch(e) 
             {
                try 
                {
                     xhr = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) 
                { 
                
                }
            }
        }
     return xhr;
}

