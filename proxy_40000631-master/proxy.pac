function FindProxyForURL(url,host)

{
    if (dnsDomainIs(host, "www.newfrontend.com")) {

      return "DIRECT";

    }

    if (isInNet(dnsResolve(host), "10.0.0.0", "255.0.0.0") ||

        isInNet(dnsResolve(host), "172.16.0.0", "255.240.0.0") ||

        isInNet(dnsResolve(host), "192.168.0.0", "255.255.0.0")) {

          return "DIRECT";

    }

    if (isInNet(dnsResolve(host), "127.0.0.0", "255.0.0.0")) {
          return "DIRECT";
    }

    return "PROXY newproxy1.40000631.qpc.hal.davecutting.uk:80";
    
}
