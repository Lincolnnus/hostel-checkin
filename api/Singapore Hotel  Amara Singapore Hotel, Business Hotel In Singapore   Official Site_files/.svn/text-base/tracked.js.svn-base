var time = new Date();
var sec = time.getSeconds();
motif0 = /.*:\/\//;
motif1 = /\/.*$/;
motif2 = / /;
refname = document.referrer;
dname = document.location.hostname;
t0 = dname;
t1 = t0.replace(motif0, " ");
t2 = t1.replace(motif1, '');
t3 = t2.replace(motif2, '');
dname = t3.toLowerCase();
escapeddname = escape(dname);
t0 = refname;
t1 = t0.replace(motif0, " ");
t2 = t1.replace(motif1, '');
t3 = t2.replace(motif2, '');
refname = t3.toLowerCase();
if(dname != refname && refname.length > 0 && dname.length > 0) {
	document.write("<IMG SRC='http://secure.fastbooking.com/00000001/032/TRACKING/origin.phtml?sec="+sec+"&origin="+escape(refname)+"&dname="+escapeddname+"' height='1' width='1' border='0'>");
}
if(dname != refname && dname.length > 0) {
	document.write("<IMG SRC='http://secure.fastbooking.com/00000001/032/TRACKING/visit.phtml?sec="+sec+"&dname="+escapeddname+"' height='1' width='1' border='0'>");
}