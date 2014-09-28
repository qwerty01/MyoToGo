import json
import urllib2
import base64

def GetQueue():
	request = urllib2.Request("http://hackathon.qw3rty01.com/myo/func")
	base64string = base64.encodestring('%s:%s' % ("testuser", "testpass")).replace('\n', '')
	request.add_header("Authorization", "Basic %s" % base64string)   
	result = json.load(urllib2.urlopen(request))
	ret = [result['error']]
	if result['error'] == False:
		ret.append(result['queue'])
		return ret
	return ret + result['message']

def PopQueue():
	request = urllib2.Request("http://hackathon.qw3rty01.com/myo/func/pop")
	base64string = base64.encodestring('%s:%s' % ("testuser", "testpass")).replace('\n', '')
	request.add_header("Authorization", "Basic %s" % base64string)   
	result = json.load(urllib2.urlopen(request))
	ret = [result['error']]
	if result['error'] == False:
		ret.append(result['function'])
		return ret
	return ret + result['message']

print GetQueue()
print PopQueue()