<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
		header("Location: ./index.php");  //0.登入後查看
	}
	$rs=$_SESSION["acc_info"];
    $id=$_SESSION["acc_info"]["id"]; 
	$class=floor($id/100);

	$sql1="SELECT name FROM `account` WHERE floor(id/100)= :v1";
    $stmt=$db->prepare($sql1);
    $stmt->bindParam(":v1", $class);
    $stmt->execute();                     //1.A0:班級成員名單
	$nodes=json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

	$sql2="SELECT id%100-1 as source, A0%100-1 as target, A4d as date, A1, A3 FROM `record` WHERE id=$id";
    $stmt=$db->prepare($sql2);
    $stmt->execute();                     
	$links=json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

	date_default_timezone_set("Asia/Taipei");
    $today=date("Y-m-d");
	$last7date=date("Y-m-d", strtotime($today."-7 day"));

    $sql3="SELECT date, A1, A2, A3, A4, A7, A8, A9, A10, A11 FROM `lifediary` WHERE id=$id order by date";
    $stmt=$db->prepare($sql3);
    $stmt->execute();                     
	$lifediary=json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="/css/phone.css" rel="stylesheet" media="only screen and (max-width:800px)">
    <link href="/css/desktop.css" rel="stylesheet" media="only screen and (min-width:800px)">
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>


<body style="background-color: #F7F7FC">
    <div id="Dashboard">
        <br>
        <div id="Tab_Selection">
            <div style="display: inline-block; background: white; text-shadow: none; border-radius: 6px; box-shadow: 0 2px 5px 0 rgba(51,51,79,.07)">
                <div id="Header1" style="background-color: #3C3FAF; display: inline-block; float: center; border-radius: 6px">
                    <a href="#" id="header1" class="headers" style="text-decoration: none; color: white; font-size: 1.2rem; margin: 1.5rem" onclick="opentab('Header1', 'header1', 'month')">Month</a>
                </div>
                
                <div id="Header2" style="display: inline-block; float: center; border-radius: 6px">
                    <a href="#" id="header2" class="headers" style="text-decoration: none; color: black; margin: 1.5rem; font-size: 1.2rem" onclick="opentab('Header2', 'header2', 'weekday')">Week</a>
                </div>
                
                <div id="Header3" style="display: inline-block; float: center; border-radius: 6px;">    
                    <a href="#" id="header3" class="headers" style="text-decoration: none; color: black; margin: 1.5rem; font-size: 1.2rem" onclick="opentab('Header3', 'header3', 'today')">Today</a>
                </div>     
            </div>
            <div style="clear: both"></div>
        </div><br>
        
        <div id="Cards">
            <div class="Card" id="Card1">
                <div id="Network" style="background-color: white; font-size: 0.8rem">
                    <svg id="G1"></svg>
                </div>
                
                <div id="Tab_Selection" style="width: 95%; display: flex; flex-wrap: wrap; margin: 0 auto; align-content: flex-start; padding-bottom: 0.1rem; padding-top: 0.1rem">
                    <div id="Tab_title">內容：</div>
                    <div style="display: inline-block; text-shadow: none">
                        <div id="Header11" class="Headers1" style="background-color: #3C3FAF">
                            <a href="#" id="header11" class="headers1" style="color: white" onclick="opentab_content('Header11', 'header11', '全部')">全部</a>
                        </div>
                        <div id="Header12" class="Headers1">
                            <a href="#" id="header12" class="headers1" onclick="opentab_content('Header12', 'header12', '社交聊天')">社交聊天</a>
                        </div>    
                        <div id="Header13" class="Headers1">    
                            <a href="#" id="header13" class="headers1" onclick="opentab_content('Header13', 'header13', '課業')">課業</a>
                        </div>  
                        <div id="Header14" class="Headers1">    
                            <a href="#" id="header14" class="headers1" onclick="opentab_content('Header14', 'header14', '休閒娛樂')">休閒娛樂</a>
                        </div>  
                        <div id="Header15" class="Headers1">    
                            <a href="#" id="header15" class="headers1" onclick="opentab_content('Header15', 'header15', '運動')">運動</a>
                        </div>  
                        <div id="Header16" class="Headers1">    
                            <a href="#" id="header16" class="headers1" onclick="opentab_content('Header16', 'header16', '其他')">其他</a>
                        </div>  
                    </div>
                    <div style="clear: both"></div>
                </div>
                
                <div id="Tab_Selection" style="width: 95%; display: flex; flex-wrap: wrap; margin: 0 auto; align-content: flex-start; padding-bottom: 0.1rem; padding-top: 0.1rem; text-align: center">
                    <div id="Tab_title">方法：</div>
                    <div style="display: inline-block; text-shadow:none">
                        <div id="Header21" class="Headers2" style="background-color: #3C3FAF">
                            <a href="#" id="header21" class="headers2" style="color:white" onclick="opentab_method('Header21', 'header21', '全部')">全部</a>
                        </div>
                        <div id="Header22" class="Headers2">
                            <a href="#" id="header22" class="headers2" onclick="opentab_method('Header22', 'header22', '見面')">見面</a>
                        </div>    
                        <div id="Header23" class="Headers2">    
                            <a href="#" id="header23" class="headers2" onclick="opentab_method('Header23', 'header23', '即時語音通話')">即時語音通話</a>
                        </div>  
                        <div id="Header24" class="Headers2">    
                            <a href="#" id="header24" class="headers2" onclick="opentab_method('Header24', 'header24', '文字或錄音')">文字或錄音</a>
                        </div>  
                        <div id="Header25" class="Headers2">    
                            <a href="#" id="header25" class="headers2" onclick="opentab_method('Header25', 'header25', '視訊')">視訊</a>
                        </div>  
                    </div>
                    <div style="clear: both"></div>
                </div>
                <br>
            </div>
            <div class="Card" id="Card2">
                <div id="G2" style="font-size: 1.2rem"></div>
                <div id="G3" style="font-size: 1.2rem"></div>
            </div>
            <div class="Card" id="Card1" style="font-weight: bold">
                <div id="G6" style="font-size: 1.2rem; text-align: left"></div>
                <div id="G6-1" style="font-size: 5rem; text-align: center"></div>
            </div>
            <div class="Card" id="Card8" style="height: auto">
                <div id="G8"></div>
            </div>
        </div>
    </div>
        
    <script>
        var Width=document.getElementById("Network").clientWidth;
        var Height=document.getElementById("Network").clientHeight;

        var today=new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        var lastday=new Date(today.getTime()-(86400000));  
        var weekday=new Date(today.getTime()-(today.getDay()*86400000));    
        var lastweekday=new Date(today.getTime()-((7+today.getDay())*86400000)); 
        var monthday=new Date(today.getFullYear(), today.getMonth());
        var lastmonthday=new Date(today.getFullYear(), today.getMonth()-1);

        var id=<?php echo $id%100 ?>-1;
        var nodes=<?php echo $nodes ?>;
        var Links=<?php echo $links ?>;
        var links=<?php echo $links ?>.filter(function(obj){
            return new Date(obj.date)>=monthday;
        })
        var Content="全部";
        var Method="全部";
        var Sel_date="month";
        var Startdate=monthday;
        var lifediary=<?php echo $lifediary ?>.filter(function(obj){
            return new Date(obj.date)>=monthday;
        })

        for(var i=0; i<lifediary.length; i++){
            if(lifediary[i].A1==="完全沒有壓力") {
                lifediary[i].A1=0;
            }else if(lifediary[i].A1==="有點壓力"){
                lifediary[i].A1=1;
            }else if(lifediary[i].A1==="很有壓力"){
                lifediary[i].A1=2;
            }

            if(lifediary[i].A2==="完全沒有壓力"){
                lifediary[i].A2=0;
            }else if(lifediary[i].A2==="有點壓力"){
                lifediary[i].A2=1;
            }else if(lifediary[i].A2==="很有壓力"){
                lifediary[i].A2=2;
            }

            if(lifediary[i].A3==="完全沒有壓力"){
                lifediary[i].A3=0;
            }else if(lifediary[i].A3==="有點壓力"){
                lifediary[i].A3=1;
            }else if(lifediary[i].A3==="很有壓力"){
                lifediary[i].A3=2;
            }

            if(lifediary[i].A4==="很不滿意"){
                lifediary[i].A4=0;
            }else if(lifediary[i].A4==="有點不滿意"){
                lifediary[i].A4=1;
            }else if(lifediary[i].A4==="有點滿意"){
                lifediary[i].A4=2;
            }else if(lifediary[i].A4==="很滿意"){
                lifediary[i].A4=3;
            }

            if(lifediary[i].A7==="完全沒有動力"){
                lifediary[i].A7=0;
            }else if(lifediary[i].A7==="有點動力"){
                lifediary[i].A7=1;
            }else if(lifediary[i].A7==="充滿動力"){
                lifediary[i].A7=2;
            }

            if(lifediary[i].A8==="不到 1 小時"){
                lifediary[i].A8=0;
            }else if(lifediary[i].A8==="1～3 小時"){
                lifediary[i].A8=1;
            }else if(lifediary[i].A8==="3～5 小時"){
                lifediary[i].A8=2;
            }else if(lifediary[i].A8==="大於 5 小時"){
                lifediary[i].A8=3;
            }

            if(lifediary[i].A9==="很不充實"){
                lifediary[i].A9=0;
            }else if (lifediary[i].A9==="有點不充實"){
                lifediary[i].A9=1;
            }else if (lifediary[i].A9==="有點充實"){
                lifediary[i].A9=2;
            }else if (lifediary[i].A9==="很充實"){
                lifediary[i].A9=3;
            }

            if(lifediary[i].A10==="很低"){
                lifediary[i].A10=0;
            }else if (lifediary[i].A10==="有點低"){
                lifediary[i].A10=1;
            }else if (lifediary[i].A10==="有點高"){
                lifediary[i].A10=2;
            }else if (lifediary[i].A10==="很高"){
                lifediary[i].A10=3;
            }

            if(lifediary[i].A11==="很不好"){
                lifediary[i].A11=0;
            }else if (lifediary[i].A11==="有點不好"){
                lifediary[i].A11=1;
            }else if (lifediary[i].A11==="有點好"){
                lifediary[i].A11=2;
            }else if (lifediary[i].A11==="很好"){
                lifediary[i].A11=3;
            }
        }			

        draw_network(nodes, links, "month");
        draw_pie(links, "month");
        draw_bar(links, "month");
        draw_max(nodes, links, "month");
        draw_area(lifediary, "month");

        function convertDate(date){
            return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
        }

        function draw_sel(sel_date){
            if(sel_date=="month"){
                Startdate=monthday;
                draw_network(nodes, links, sel_date);
                draw_pie(links, sel_date);
                draw_max(nodes, links, sel_date);
                draw_area(lifediary, sel_date);
                return;
            }else if(sel_date=="weekday"){
                Startdate=weekday;
                var new_links=links.filter(function(obj){
                    return new Date(obj.date)>=Startdate;
                });	
                var new_lifediary=lifediary.filter(function(obj){
                    return new Date(obj.date)>=Startdate;
                });
            }else if(sel_date=="today"){
                Startdate=today;
                var new_links=links.filter(function(obj){
                    return new Date(obj.date)>=today;
                });
                var new_lifediary=lifediary.filter(function(obj){
                    return new Date(obj.date)>=lastday;
                });	
            }
            draw_network(nodes, new_links, sel_date);
            draw_pie(new_links, sel_date);
            draw_max(nodes, new_links, sel_date);
            draw_area(new_lifediary, sel_date);
        }

        function draw_sel_network(){
            if(Content=="全部" & Method=="全部"){
                var new_links=links.filter(function(obj){
                    return new Date(obj.date)>=Startdate;
                });
            }else if(Content!="全部" & Method=="全部"){
                var new_links=links.filter(function(obj){
                    return new Date(obj.date)>=Startdate & obj.A1==Content;
                });
            }else if(Content=="全部" & Method!="全部"){
                var new_links=links.filter(function(obj){
                    return new Date(obj.date)>=Startdate & obj.A3==Method;
                });
            }else{
                var new_links=links.filter(function(obj){
                    return new Date(obj.date)>=Startdate & obj.A1==Content && obj.A3==Method;
                });
            }
            draw_network(nodes, new_links, Sel_date);
        }

        function opentab(Header, header, sel_date){
            var cheaders=document.getElementsByClassName("headers");
            for(var i=0; i<cheaders.length; i++){
                 cheaders[i].style.color="black";
            }
            document.getElementById("Header1").style.background="white";
            document.getElementById("Header2").style.background="white";
            document.getElementById("Header3").style.background="white";              
            document.getElementById(Header).style.background="#3C3FAF";
            document.getElementById(header).style.color="white";

            Sel_date=sel_date;
            draw_sel(sel_date);
            opentab_content("Header11", "header11", "全部");
            opentab_method("Header21", "header21", "全部");
        }

        function opentab_content(Header, header, sel){
            var cheaders=document.getElementsByClassName("headers1");
            var cHeaders=document.getElementsByClassName("Headers1");
            for(var i=0; i<cheaders.length; i++){
                cHeaders[i].style.background="";
                cheaders[i].style.color="#3C3FAF";
            }         
            document.getElementById(Header).style.background="#3C3FAF";
            document.getElementById(header).style.color="white";
            Content=sel;
            draw_sel_network();
        }

        function opentab_method(Header, header, sel){
            var cheaders=document.getElementsByClassName("headers2");
            var cHeaders=document.getElementsByClassName("Headers2");
            for(var i=0; i<cheaders.length; i++){
                cHeaders[i].style.background="";
                cheaders[i].style.color="#3C3FAF";
            }         
            document.getElementById(Header).style.background="#3C3FAF";
            document.getElementById(header).style.color="white";
            Method=sel;
            draw_sel_network();
        }

        function draw_network(nodes, links, sel_date){
            if(sel_date=="month"){
                var Month=["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"];
                var Title=(Month[today.getMonth()])+"月的個人網絡";
            }else if(sel_date=="weekday"){
                var Title="本週的個人網絡";   
            }else if(sel_date=="today"){
                var Title="今天的個人網絡";
            }

            document.getElementById("G1").setAttribute("width", Width);
            document.getElementById("G1").setAttribute("height", Height);

            var svg=d3.select("#G1"),
                width=Width,
                height=Height;
            svg.selectAll("*").remove();

            var color=d3.scaleOrdinal()
                .range(d3.schemeCategory20);

            var simulation=d3.forceSimulation()
                .force("link", d3.forceLink())
                .force("charge", d3.forceManyBody())
                .force("center", d3.forceCenter(width/2, height/2+height/15));

            var link=svg.append("g")
                .attr("class", "links")
                .selectAll("line")
                .data(links)
                .enter().append("line")
                .attr("stroke-width", 5)
                .attr("stroke","black");

            var node=svg.append("g")
                .attr("class", "nodes")
                .selectAll("circle")
                .data(nodes)
                .enter().append("circle")
                .attr("r", 20)
                .attr("fill", function(d, i){if(i==id){return "blue"}else{return "rgba(60, 63, 175, 0.8)"}})
                .call(d3.drag()
                    .on("start", dragstarted)
                    .on("drag", dragged)
                    .on("end", dragended));

            var text=svg.selectAll("text")
                 .data(nodes)
                 .enter()
                 .append("text")
                 .style("fill", "white")
                 .attr("dx", -20)
                 .attr("dy", 6)
                 .text(function(d){
                    return d.name;
                 });

            simulation
                .nodes(nodes)
                .on("tick", ticked);

            simulation.force("link")
                .links(links)
                .distance(150);

            simulation.force("charge")
                .strength(-50);

            svg.append("text")
                .attr("x", (width / 2))             
                .attr("y",  height/15)
                .attr("text-anchor", "middle")  
                .style("font-size", "1.2rem")
                .style("font-weight", "bold")
                .text(Title);				

            function ticked(){
                link
                    .attr("x1", function(d){return d.source.x})
                    .attr("y1", function(d){return d.source.y})
                    .attr("x2", function(d){return d.target.x})
                    .attr("y2", function(d){return d.target.y});
                
                node
                    .attr("cx", function(d){return d.x})
                    .attr("cy", function(d){return d.y});
                
                text
                    .attr("x", function(d){return d.x})
                    .attr("y", function(d){return d.y});
            };

            function dragstarted(d){
                if(!d3.event.active)simulation.alphaTarget(0.3).restart();
                d.fx=d.x;
                d.fy=d.y;
            }

            function dragged(d){
                d.fx=d3.event.x;
                d.fy=d3.event.y;
            }

            function dragended(d){
                if(!d3.event.active)simulation.alphaTarget(0);
                d.fx=null;
                d.fy=null;
            }
        }

        function draw_pie(links, sel_date){
            document.getElementById("G2").innerHTML="";

            if(sel_date=="month"){
                var Month=["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"];
                var Title=(Month[today.getMonth()])+"月的互動內容分布";
            }else if(sel_date=="weekday"){
                var Title="本週的互動內容分布";   
            }else if(sel_date=="today"){
                var Title="今天的互動內容分布";
            }

            a1=links.filter(function(obj){
                return obj.A1=="社交聊天";
            }).length;
            a2=links.filter(function(obj){
                return obj.A1=="課業";
            }).length;
            a3=links.filter(function(obj){
                return obj.A1=="休閒娛樂";
            }).length;
            a4=links.filter(function(obj){
                return obj.A1=="運動";
            }).length;
            a5=links.filter(function(obj){
                return obj.A1=="其他";
            }).length;

            var options={
                series:[a1, a2, a3, a4, a5],
                labels:["社交聊天", "課業", "休閒娛樂", "運動", "其他"],
                chart:{
                    type: "donut",
                },
                responsive:[{
                    breakpoint: 800,
                    options:{
                        legend:{
                            position: "bottom"
                        }
                    }
                }],
                title:{
                    text: Title,
                    offsetY: 25,
                    offsetX: 60,
                    style: {
                        fontSize: "1.2rem",
                    }
                },
                stroke:{
                  width: 1,
                },
                colors:["#FF78C7", "#FF3CAE", "#FF0095", "#E10083", "#C30072"],					
                plotOptions:{
                    pie:{
                        expandOnClick: true,
                        customScale: 1,
                        donut:{
                            size: "65%",
                            labels:{
                                show: true,
                                name:{
                                    color: "black",	
                                },
                                value:{
                                    showAlways: false,
                                    show: true,
                                    fontSize: "20px",
                                    fontFamily: "Georgia",
                                    fontWeight: "bold",
                                },
                                total:{
                                    label: "總共",
                                    showAlways: false,
                                    show: true,
                                    fontSize: "20px",
                                    fontFamily: "Microsoft JhengHei, Heiti-TC",
                                    fontWeight: "bold",
                                    color: "black",
                                },
                            }
                        }
                    }
                },
                legend:{
                    fontSize: "14px",
                },
                tooltip:{
                    enabled: false,
                },
                dataLabels:{
                    style:{
                        fontSize: "14px",
                        fontWeight: "bold",
                        fontFamily: "Georgia",
                    },
                }
            };

            var chart=new ApexCharts(document.querySelector("#G2"), options);
            chart.render();
        }

        function draw_bar(links, sel_date){
            if(sel_date=="month"){
                var last_links=Links.filter(function(obj){
                    return new Date(obj.date)>=lastmonthday & new Date(obj.date)<monthday							  
                });
                console.log(last_links);
                var labels=["上個月", "這個月"];
                var Title="上個月與這個月的互動內容";
                
            }else if(sel_date=="weekday"){
                var last_links=Links.filter(function(obj){
                    return new Date(obj.date)>=lastweekday & new Date(obj.date)<weekday							  
                });
                var labels=["上星期", "這星期"];
                var Title="上星期與這星期的互動內容";
                
            }else if(sel_date=="today"){
                var last_links=Links.filter(function(obj){
                    return new Date(obj.date)>=lastday & new Date(obj.date)<today							  
                });
                var labels=["昨天", "今天"];
                var Title="昨天與今天的互動內容";
            }

            a11=last_links.filter(function(obj){
                return obj.A1=="社交聊天";
            }).length;
            a12=last_links.filter(function(obj){
                return obj.A1=="課業";
            }).length;
            a13=last_links.filter(function(obj){
                return obj.A1=="休閒娛樂";
            }).length;
            a14=last_links.filter(function(obj){
                return obj.A1=="運動";
            }).length;
            a15=last_links.filter(function(obj){
                return obj.A1=="其他";
            }).length;
            s1=[a11, a12, a13, a14, a15];

            a21=links.filter(function(obj){
                return obj.A1=="社交聊天";
            }).length;
            a22= links.filter(function(obj){
                return obj.A1=="課業";
            }).length;
            a23= links.filter(function(obj){
                return obj.A1=="休閒娛樂";
            }).length;
            a24= links.filter(function(obj){
                return obj.A1=="運動";
            }).length;
            a25= links.filter(function(obj){
                return obj.A1=="其他";
            }).length;
            s2=[a21, a22, a23, a24, a25];

            var options={
                series:[{
                    name: labels[0],
                    data: s1
                },{
                    name: labels[1],
                    data: s2
                }],
                chart:{
                    type: "bar",
                    height: 350,
                    stacked: true,
                },
                plotOptions:{
                    bar:{
                        horizontal: true,
                    },
                },
                stroke:{
                    width: 1,
                    colors: ["#fff"]
                },
                title:{
                    text: Title,
                },
                xaxis:{
                    categories:["社交聊天", "課業", "休閒娛樂", "運動", "其他"],
                    labels:{
                        formatter: function(val){
                            return val;
                        }
                    }
                },
                yaxis:{
                    title:{
                        text: undefined
                    },
                },
                tooltip:{
                    y:{
                        formatter: function(val){
                            return val+"K";
                        }
                    }
                },
                fill:{
                    opacity: 1
                },
                legend:{
                    position: "top",
                    horizontalAlign: "left",
                    offsetX: 40
                }
            };

            var chart=new ApexCharts(document.querySelector("#G3"), options);
            chart.render();
        }

        function draw_area(data, sel_date){  
            document.getElementById("G8").innerHTML="";
            var X_title="";

            if(sel_date=="month"){
                function convertdate(date){
                    return date.getDate();
                }
                var Month=["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"];
                var X=data.map(function(x, index){return convertdate(new Date(x["date"]))});
                var X_title="日期";
                var Title=(Month[today.getMonth()])+"月的壓力變化";
                var S1=data.map(function(x, index){return x["A1"]});
                var S2=data.map(function(x, index){return x["A2"]});
                var S3=data.map(function(x, index){return x["A3"]});
                
            }else if(sel_date=="weekday"){
                function convertdate(date){
                    return date.getDay();
                }
                var Week=["日","一", "二", "三", "四", "五", "六"];
                var X=data.map(function(x, index){
                    return "星期"+Week[convertdate(new Date(x["date"]))]; 
                });
                var X_title="";
                var Title="本週的壓力變化";
                var S1=data.map(function(x, index){return x["A1"]});
                var S2=data.map(function(x, index){return x["A2"]});
                var S3=data.map(function(x, index){return x["A3"]});

            }else if(sel_date=="today"){					
                var X=["昨天", "今天"];
                var Title="昨天到今天的壓力變化";
                var lifediary_D1=data.filter(function(obj){
                    return new Date(obj.date)>=lastday && new Date(obj.date)<today;
                });
                var lifediary_D2=data.filter(function(obj){
                    return new Date(obj.date)>=today;
                });

                if((lifediary_D1.map(function(x, index){
                    return x["A1"]})).length==0){var S11=NaN}
                else{var S11=lifediary_D1.map(function(x, index){return x["A1"]})}
                if((lifediary_D2.map(function(x, index){
                    return x["A1"]})).length==0){var S12=NaN}
                else{var S12=lifediary_D2.map(function(x, index){return x["A1"]})}
                if((lifediary_D1.map(function(x, index){
                    return x["A2"]})).length==0){var S21=NaN}
                else{var S21=lifediary_D1.map(function(x, index){return x["A2"]})}
                if((lifediary_D2.map(function(x, index){
                    return x["A2"]})).length==0){var S22=NaN}
                else{var S22=lifediary_D2.map(function(x, index){return x["A2"]})}
                if((lifediary_D1.map(function(x, index){
                    return x["A3"]})).length==0){var S31=NaN}
                else{var S31=lifediary_D1.map(function(x, index){return x["A3"]})}
                if((lifediary_D2.map(function(x, index){
                    return x["A3"]})).length==0){var S32=NaN}
                else{var S32=lifediary_D2.map(function(x, index){return x["A3"]})}
                var S1=[S11[0], S12[0]];
                var S2=[S21[0], S22[0]];
                var S3=[S31[0], S32[0]];
            }

            var options={
                series:[{
                    name: "來自家庭的壓力",
                    data: S1
                },{
                    name: "來自師長的壓力",
                    data: S2
                },{
                    name: "來自同學的壓力",
                    data: S3
                }],
                chart:{
                    height: 350,
                    type: "area",
                    zoom:{enabled: false},
                    stacked: true
                },
                dataLabels:{
                    enabled: false
                },
                markers:{
                    size: 6
                },
                stroke:{
                    curve: "straight",
                    width: 3
                },
                title:{
                    text: Title,
                    align: "center",
                    offsetY: 25, 
                    style:{
                        fontSize: "1.2rem",
                    }
                },
                xaxis:{
                    type: "date",
                    categories: X,
                    title:{   
                        text: X_title,
                        style:{
                            fontSize: "1.0rem",
                        }
                    },
                    tickAmount: 7,
                },
                yaxis:{
                    title:{
                        text: "壓力指數", 
                        style:{
                            fontSize: "1.0rem",
                        }
                    },
                },
                tooltip:{
                    y:{
                        formatter: function (value){
                            var pressure=["完全沒有壓力", "有點壓力", "壓力山大"];
                            return pressure[value];
                        }
                    }
                },
                colors:[
                    "#b465da", "#cf6cc9", "#ee609c"
                ],
                legend:{
                    show: true,
                    fontSize: "14px",
                },
            }
            
            var chart=new ApexCharts(document.querySelector("#G8"), options);
            chart.render();            
        }

        function draw_max(nodes, links, sel_date){
            if(sel_date=="month"){
                var Month=["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"];
                var Title=(Month[today.getMonth()])+"月最常互動的對象";
            }else if(sel_date=="weekday"){
                var Title="本週最常互動的對象";   
            }else if(sel_date=="today"){
                var Title="今天最常互動的對象";
            }

            document.getElementById("G6").textContent=Title;
            document.getElementById("G6-1").textContent=count_amount(nodes, links);
        } 

        function count_amount(nodes, links){
            var All_alter=nodes.map(function(x, index){return x["name"]});
            var Alter=links.map(function(x, index){return x["target"]});
            var total_nodes=[];

            for(var i=0; i<nodes.length; i++){
                total_nodes[i]=Alter.filter(function(obj){
                    return obj.index==i;
                }).length;	
            }
            pois=total_nodes.indexOf(Math.max(...total_nodes));
            
            return All_alter[pois];
        }
    </script>
</body>
</html>
